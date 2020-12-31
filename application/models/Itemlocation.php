<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Itemlocation table
 */
class Itemlocation extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_items_location', 'id', 'itm_loc' );
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{
		// default where clause
		if ( !isset( $conds['no_publish_filter'] )) {
			$this->db->where( 'status', 1 );
		}

		// id condition
		if ( isset( $conds['id'] )) {
			$this->db->where( 'id', $conds['id'] );
		}

		// name condition
		if ( isset( $conds['name'] )) {
			$this->db->where( 'name', $conds['name'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->like( 'name', $conds['searchterm'] );
		}

		// keyword
		if ( isset( $conds['keyword'] )) {
			$this->db->like( 'name', $conds['keyword'] );
		}

		// name condition
		if ( isset( $conds['ordering'] )) {
			$this->db->where( 'ordering', $conds['ordering'] );
		}

		// order_by
		if ( isset( $conds['order_by'] )) {

			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];

			$this->db->order_by( 'bs_items_location.'.$order_by_field, $order_by_type );
		} else {

			$this->db->order_by( 'added_date' , 'desc' );
		}
	}
}