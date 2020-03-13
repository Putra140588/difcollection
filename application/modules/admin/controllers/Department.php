<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Department extends CI_Controller{
	var $class;
	var $table;
	var $datenow;
	var $addby;
	var $access_code;
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->class = strtolower(__CLASS__);
		$this->table = 'tb_departement';
		$this->datenow = date('Y-m-d H:i:s');
		$this->addby = $this->session->userdata('first_name');
		$this->access_code = 'DPRT';
		$this->m_admin->maintenance();
	}	
	function index(){
		$this->m_admin->sess_login();
		$priv = $this->m_admin->get_priv($this->access_code,'view');
		$body= (empty($priv)) ? $this->class.'/vw_department' : $priv['error'];
		$data['notif']= (empty($priv)) ? '' : $priv['notif'];
		links(MODULE.'/'.$this->class);
		url_sess(base_url(MODULE.'/'.$this->class));//link for menu active
		$data['page_title'] = 'Data '.__CLASS__;
		$data['body'] = $body;
		$data['class'] = $this->class;		
		$this->load->view('vw_header',$data);
	}
	function column(){
		$field_array = array(
			0 => 'date_add',
			1 => 'code_departement',
			2 => 'name_departement',
			3 => 'add_by',
			4 => 'date_add',							
		);
		return $field_array;
	}
	
	function get_records(){
		$output = array();		
		//load datatable
		$this->m_admin->datatable();
		$total = count($this->m_admin->get_department());
		$output['draw'] = $_REQUEST['draw'];
		$output['csrf_token'] = csrf_token()['hash'];//reload hash token diferent
		$output['recordsTotal']= $output['recordsFiltered'] = $total;	
		//date filter value already set index row column
		$date_from = $_REQUEST['columns'][0]['search']['value'];
		$date_to = $_REQUEST['columns'][4]['search']['value'];
		$this->m_admin->range_date($this->column(),$date_from,$date_to);
		$query = $this->m_admin->get_department('',$this->column());
		$this->m_admin->range_date($this->column(),$date_from,$date_to);
		$total = count($this->m_admin->get_department());
		$output['recordsFiltered'] = $total;
		
		$output['data'] = array();
		$no = $_REQUEST['start'] + 1;
		foreach ($query as $row){
			$actions='';
			
			//jika login bukan sebagai superadmin, maka action pada superadmin tidak ditampilkan
			if ($row->code_departement != 'SA'){
				$actions = '<a class="btn btn-xs btn-success" href="'.base_url(MODULE.'/'.$this->class.'/access/'.$row->code_departement).'" title="Access Permission" data-rel="tooltip" data-placement="top">'.icon_action('access').'</a>
					   	    <a class="btn btn-xs btn-info" href="'.base_url(MODULE.'/'.$this->class.'/form/'.$row->id_departement).'" title="Edit" data-rel="tooltip" data-placement="top">'.icon_action('edit').'</a>
						   <a class="btn btn-xs btn-danger" onclick="DeleteConfirm(\''.base_url(MODULE.'/'.$this->class.'/delete').'\',\''.$row->id_departement.'\')" title="Delete" data-rel="tooltip" data-placement="top">'.icon_action('delete').'</a>';
				
			}
			//jika login sebagai superadmin action ditampilkan semua
			if ($this->session->userdata('code_dep') == 'SA'){
				$actions = '<a class="btn btn-xs btn-success" href="'.base_url(MODULE.'/'.$this->class.'/access/'.$row->code_departement).'" title="Access Permission" data-rel="tooltip" data-placement="top">'.icon_action('access').'</a>
					   	    <a class="btn btn-xs btn-info" href="'.base_url(MODULE.'/'.$this->class.'/form/'.$row->id_departement).'" title="Edit" data-rel="tooltip" data-placement="top">'.icon_action('edit').'</a>
						   <a class="btn btn-xs btn-danger" onclick="DeleteConfirm(\''.base_url(MODULE.'/'.$this->class.'/delete').'\',\''.$row->id_departement.'\')" title="Delete" data-rel="tooltip" data-placement="top">'.icon_action('delete').'</a>';
			}
			
						
			$output['data'][] = array(
					$no,
					$row->code_departement,
					$row->name_departement,
					$row->add_by,					
					long_date_time($row->date_add),					
					$actions
			);
			$no++;
		}
		echo json_encode($output);
	}
	function form($id=""){
		$this->m_admin->sess_login();
		if (!empty($id)){
			links(MODULE.'/'.$this->class.'/form/'.$id);
			$action = 'edit';
			$data['page_title'] = 'Edit '.__CLASS__;
			$sql = $this->m_admin->get_table($this->table,'*',array('id_departement'=>$id));			
			foreach ($sql as $row)
				foreach ($row as $key=>$val){
				$data[$key] = $val;
			}
		}else{
			links(MODULE.'/'.$this->class.'/form/');
			$data['page_title'] = 'Add New '.__CLASS__;
			$action = 'add';
		}
		$priv = $this->m_admin->get_priv($this->access_code,$action);
		$body= (empty($priv)) ? $this->class.'/vw_crud' : $priv['error'];
		$data['body'] = $body;
		$data['class'] = $this->class; 		
		$data['notif']= (empty($priv)) ? '' : $priv['notif'];		
		$this->load->view('vw_header',$data);
	}
	function proses(){
		$this->db->trans_start();	
		$id_departement = $this->input->post('id_departement',true);
		$code = $this->input->post('code',true);		
		$post['name_departement']= $this->input->post('name',true);			
		if (!empty($id_departement)){			
			$res = $this->m_admin->editdata($this->table,$post,array('id_departement'=>$id_departement));
			$alert = 'Edit data '.__CLASS__.' successfull';
		}else{
			//addnew			
			$post['code_departement']=$code;
			$post['date_add']=$this->datenow;
			$post['add_by']=$this->addby;
			if ($this->cek_code($code) == false){
				$res = $this->m_admin->insertdata($this->table,$post);
				$sql = $this->m_admin->get_table('tb_modul','modul_code',array('deleted'=>0));
				foreach ($sql as $row){
					$in['code_departement'] = $code;
					$in['modul_code'] = $row->modul_code;
					$in['add_by'] = $this->addby;
					$in['date_add'] = $this->datenow;
					$batch[] = $in;
				}
				$res = $this->db->insert_batch('tb_priv',$batch);
				$alert = 'Add new data '.__CLASS__.' successfull';
			}else{
				$alert = 'Code '.__CLASS__.' already exist,please use other code';
				$res = 0;
			}			
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			if ($res > 0){
				$this->db->trans_complete();
				$this->session->set_flashdata('success',$alert);
				echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>0,'msg'=>$alert,'type'=>'save','redirect'=>base_url($this->session->userdata('links'))));
			}else{
				echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>1,'msg'=>$alert,'type'=>'error'));
			}
		}
		
	}	
	function cek_code($code){
		$qr = $this->m_admin->get_table($this->table,'code_departement',array('code_departement'=>$code,'deleted'=>0));
		if (count($qr) > 0){
			return true;
		}else{
			return false;
		}		
	}
	function delete(){
		$priv = $this->m_admin->get_priv($this->access_code,'delete');
		if (empty($priv)){
			$id = $this->input->post('value',true);
			$res = $this->m_admin->editdata($this->table,array('deleted'=>1),array('id_departement'=>$id));
			if ($res > 0){
				$msg = 'Delete data '.__CLASS__.' successfull';
				echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>0,'msg'=>$msg,'table'=>'dt'));
			}
		}else{
			echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>1,'msg'=>$priv['notif']));
		}
	}
	function count_modul($id){
		return count($this->m_admin->get_modul(array('B.code_departement'=>$id)));
	}
	function access($id){
		$this->m_admin->sess_login();
		$priv = $this->m_admin->get_priv($this->access_code,'view');
		$body= (empty($priv)) ? $this->class.'/vw_access' : $priv['error'];
		$data['notif']= (empty($priv)) ? '' : $priv['notif'];
		links(MODULE.'/'.$this->class);	
		$data['modul_parent'] = $this->m_admin->get_modul(array('A.id_modul_parent'=>0,'B.code_departement'=>$id));
		$data['count'] = $this->count_modul($id);
		$sub_title = $data['modul_parent'][0]->name_departement;
		$data['code_departement'] = $id;
		$data['page_title'] = 'Data '.__CLASS__;
		$data['sub_title'] = $sub_title;
		$data['body'] = $body;
		$data['class'] = $this->class;
		$this->load->view('vw_header',$data);
	}
	function check_permission($all){
		$priv = $this->m_admin->get_priv($this->access_code,'edit');
		if (empty($priv)){
			$expl = explode("#", $this->input->post('value',true));
			$id = $expl[0];
			$action = $expl[1];
			$cexbox = ($this->input->post('check') == 1) ? 1 : 0;
			$cx = ($cexbox == 1) ? 'Check' : 'UnCheck';
			if ($all == 1){	
				//if check all 			
				$where = array('code_departement'=>$id);
				$msg = $cx.' all '.__CLASS__.' success set '.$action;
			}else{
				//check by select
				$where = array('id_priv'=>$id);				
				$msg = $cx.' '.__CLASS__.' success set '.$action;
			}
			$update = array($action=>$cexbox);
			$res = $this->m_admin->editdata('tb_priv',$update,$where);
			if ($res > 0){
				echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>0,'msg'=>$msg));
			}
		}else{
			echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>1,'msg'=>$priv['notif']));
		}
	}
}
