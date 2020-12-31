<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Categories Controller
 */
class Sellers extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {
		
		
		parent::__construct( MODULE_CONTROL, 'SELLERS' );
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

		// //registered users filter
        // $conds = array( 'register_role_id' => 4 );
        	// no publish filter
		
		$conds['order_by'] = 1;
		$conds['order_by_field'] = "seller_id";
		$conds['order_by_type'] = "desc";

		// get rows count
		$this->data['rows_count'] = $this->Seller->count_all($conds);

		// get users
		$this->data['sellers'] = $this->Seller->get_all_by($conds, $this->pag['per_page'], $this->uri->segment( 4 ) );

		// load index logic
		parent::index();
	}

    /**
     * Search user function
     */

    function search() {

		// breadcrumb urls
		$data['action_title'] = get_msg( 'seller_search' );

		// handle search term
		$search_term = $this->searchterm_handler( $this->input->post( 'searchterm' ));
		
		// condition
		$conds = array( 'searchterm' => $search_term , 'registered_role_id' => 4);

		$this->data['rows_count'] = $this->Seller->count_all_by( $conds );

		$this->data['sellers'] = $this->Seller->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ));
		
		parent::search();
    }
    
	function edit( $id ) {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'seller_edit' );

		// load user
		$this->data['sellers'] = $this->Seller->get_one( $id );

		// call the parent edit logic
		parent::edit( $id );
	}

	
	/**
	 * Saving User Info logic
	 *
	 * @param      boolean  $user_id  The user identifier
	 */
	function save( $seller_id = false ) {
		// prepare user object and permission objects
		$seller_data = array();

		// save username
		if ( $this->has_data( 'seller_name' )) {
			$seller_data['seller_name'] = $this->get_data( 'seller_name' );
		}

		
		if( $this->has_data( 'seller_email' )) {
			$seller_data['seller_email'] = $this->get_data( 'seller_email' );
		}
		
		if( $this->has_data( 'seller_phone' )) {
			$seller_data['seller_phone'] = $this->get_data( 'seller_phone' );
		}


		// user_address
		if ( $this->has_data( 'seller_address' )) {
			$seller_data['seller_address'] = $this->get_data( 'seller_address' );
		}

		// save city
		if( $this->has_data( 'city' )) {
			$seller_data['city'] = $this->get_data( 'city' );
		}

		// save user_about_me
		if( $this->has_data( 'seller_about_me' )) {
			$seller_data['seller_about_me'] = $this->get_data( 'seller_about_me' );
		}

		// $permissions = ( $this->get_data( 'permissions' ) != false )? $this->get_data( 'permissions' ): array();

		// save data
		// print_r($user_data);die;
		if ( ! $this->Seller->save( $seller_data, $seller_id )) {
		// if there is an error in inserting user data,	

			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
		} else {
		// if no eror in inserting

			if ( $seller_id ) {
			// if user id is not false, show success_add message
				
				$this->set_flash_msg( 'success', get_msg( 'success_user_edit' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'success_user_add' ));
			}
		}

		redirect( $this->module_site_url());
	}

	function delete( $seller_id ) {

		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );
		
		// delete categories and images
		if ( !$this->ps_delete->delete_user( $seller_id )) {

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