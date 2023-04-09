<?php 

	class Dashboard extends Controllers{

		public function __construct(){
			sessionStar();
			parent::__construct();
			// session_start();
			// session_regenerate_id(true);
			if (empty($_SESSION['login'])) {
				header('location:'.base_url()."Login");
			}

			getPermisos(1);

		}

		public function dashboard()
		{
			$data['page_id']=2;
			$data['tag_page']="Dashboard - Admin";
			$data['page_title']="Dashboard - Admin";
			$data['page_name']="dashboard";
			$data['page_function_general']="";
			$this->views->getView($this,"dashboard",$data);
		}
		
	}

 ?>