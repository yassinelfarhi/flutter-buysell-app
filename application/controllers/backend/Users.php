<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Categories Controller
 */
class Users extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {
		
		
		parent::__construct( MODULE_CONTROL, 'USERS' );
		///start allow module check 
		$conds_mod['module_name'] = $this->router->fetch_class();
		$module_id = $this->Module->get_one_by($conds_mod)->module_id;
		
		$logged_in_user = $this->ps_auth->get_user_info();

		$user_id = $logged_in_user->user_id;
		if(empty($this->User->has_permission( $module_id,$user_id )) && $logged_in_user->user_is_sys_admin!=1){
			return redirect( site_url('/admin') );
		}
		///end check
	}

	/**
	 * List down the registered users
	 */



    function index() {

		//registered users filter
		// $conds = array( 'register_role_id' => 4 );

		// get rows count
		$this->data['rows_count'] = $this->User->count_all($conds);

		// get users
		$this->data['users'] = $this->User->get_all_by($conds, $this->pag['per_page'], $this->uri->segment( 4 ) );

		// load index logic
		parent::index();
	}

    /**
     * Search user function
     */

    function search() {

		// breadcrumb urls
		$data['action_title'] = get_msg( 'user_search' );

		// handle search term
		$search_term = $this->searchterm_handler( $this->input->post( 'searchterm' ));
		
		// condition
		$conds = array( 'searchterm' => $search_term , 'registered_role_id' => 4);

		$this->data['rows_count'] = $this->User->count_all_by( $conds );

		$this->data['users'] = $this->User->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ));
		
		parent::search();
    }
	
	

	function edit( $id ) {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'users_edit' );

		// load user
		$this->data['users'] = $this->User->get_one( $id );

		// call the parent edit logic
		parent::edit( $id );
	}
    
	/**
	 * Saving User Info logic
	 *
	 * @param      boolean  $user_id  The user identifier
	 */
	function save( $user_id = false ) {
		// prepare user object and permission objects
		$user_data = array();

		// save username
		if ( $this->has_data( 'user_name' )) {
			$user_data['user_name'] = $this->get_data( 'user_name' );
		}

		
		if( $this->has_data( 'user_email' )) {
			$user_data['user_email'] = $this->get_data( 'user_email' );
		}
		
		if( $this->has_data( 'user_phone' )) {
			$user_data['user_phone'] = $this->get_data( 'user_phone' );
		}


		// user_address
		if ( $this->has_data( 'user_address' )) {
			$user_data['user_address'] = $this->get_data( 'user_address' );
		}

		// save city
		if( $this->has_data( 'city' )) {
			$user_data['city'] = $this->get_data( 'city' );
		}

		// save user_about_me
		if( $this->has_data( 'user_about_me' )) {
			$user_data['user_about_me'] = $this->get_data( 'user_about_me' );
		}

		// $permissions = ( $this->get_data( 'permissions' ) != false )? $this->get_data( 'permissions' ): array();

		// save data
		// print_r($user_data);die;
		if ( ! $this->User->save( $user_data, $user_id )) {
		// if there is an error in inserting user data,	

			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
		} else {
		// if no eror in inserting

			if ( $user_id ) {
			// if user id is not false, show success_add message
				
				$this->set_flash_msg( 'success', get_msg( 'success_user_edit' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'success_user_add' ));
			}
		}

		redirect( $this->module_site_url());
	}

	function delete( $user_id ) {

		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );
		
		// delete categories and images
		if ( !$this->ps_delete->delete_user( $user_id )) {

			// set error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));

			// rollback
			$this->trans_rollback();

			// redirect to list view
			redirect( $this->module_site_url());
		}
			
		/**
		 * Check Transcation Status
		 */
		if ( !$this->check_trans()) {

			$this->set_flash_msg( 'error', get_msg( 'err_model' ));	
		} else {
        	
			$this->set_flash_msg( 'success', get_msg( 'success_user_delete' ));
		}
		
		redirect( $this->module_site_url());
	}
}