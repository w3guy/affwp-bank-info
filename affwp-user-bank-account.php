<?php
/*
 * Plugin Name: Affiliate Bank Details for AffWP
 * Plugin URL: http://w3guy.com
 * Description: Affiliate Bank Details
 * Version: 1.0
 * Author: Agbonghama Collins
 * Author URI: http://w3guy.com
 */

/**
 * Class Aff_Bank_Details
 */
class Aff_Bank_Details {

	public function __construct() {
		add_action( 'affwp_affiliate_dashboard_before_submit', array( $this, 'bank_details_form' ) );
		add_action( 'affwp_edit_affiliate_end', array( $this, 'admin_bank_details_form' ) );

		add_action( 'affwp_update_affiliate_profile_settings', array( $this, 'update_bank_details' ) );

		add_action( 'affwp_update_affiliate', array( $this, 'affwp_process_update_affiliate' ) );
	}

	/**
	 * Affiliate bank account details.
	 */
	public function bank_details_form() {
		$saved_data     = get_user_meta( get_current_user_id(), 'affwp_bank_details', true );
		$bank_name      = isset( $_POST['bank_name'] ) ? esc_attr( $_POST['bank_name'] ) : $saved_data['bank_name'];
		$account_name   = isset( $_POST['account_name'] ) ? esc_attr( $_POST['account_name'] ) : $saved_data['account_name'];
		$account_number = isset( $_POST['account_number'] ) ? esc_attr( $_POST['account_number'] ) : @$saved_data['account_number'];
		$phone_number   = isset( $_POST['phone_number'] ) ? esc_attr( $_POST['phone_number'] ) : @$saved_data['phone_number'];
		?>
		<div class="affwp-wrap affwp-payment-bank-name-wrap">
			<label for="affwp-payment-bank-name"><?php _e( 'Bank Name', 'aff_bd' ); ?></label>
			<input id="affwp-payment-bank-name" type="text" name="bank_name" value="<?php echo $bank_name; ?>"/>
		</div>
		<div class="affwp-wrap affwp-payment-account-name-wrap">
			<label for="affwp-payment-account-name"><?php _e( 'Account Name', 'aff_bd' ); ?></label>
			<input id="affwp-payment-account-name" type="text" name="account_name" value="<?php echo $account_name; ?>"/>
		</div>
		<div class="affwp-wrap affwp-payment-account-number-wrap">
			<label for="affwp-payment-account-number"><?php _e( 'Account Number', 'aff_bd' ); ?></label>
			<input id="affwp-payment-account-number" type="text" name="account_number" value="<?php echo $account_number; ?>"/>
		</div>
		<div class="affwp-wrap affwp-payment-phone-number-wrap">
			<label for="affwp-payment-phone-number"><?php _e( 'Phone Number', 'aff_bd' ); ?></label>
			<input id="affwp-payment-phone-number" type="text" name="phone_number" value="<?php echo $phone_number; ?>"/>
		</div>
	<?php
	}


	/**
	 * Update affiliate bank details.
	 *
	 * @param $data
	 */
	public function update_bank_details( $data ) {

		$bank_details = array(
			'bank_name'      => $data['bank_name'],
			'account_name'   => $data['account_name'],
			'account_number' => $data['account_number'],
			'phone_number'   => $data['phone_number']
		);

		update_user_meta( get_current_user_id(), 'affwp_bank_details', $bank_details );
	}

	public function admin_bank_details_form($affiliate) {
		$saved_data     = get_user_meta( $affiliate->user_id, 'affwp_bank_details', true );
		$bank_name      = isset( $_POST['bank_name'] ) ? esc_attr( $_POST['bank_name'] ) : $saved_data['bank_name'];
		$account_name   = isset( $_POST['account_name'] ) ? esc_attr( $_POST['account_name'] ) : $saved_data['account_name'];
		$account_number = isset( $_POST['account_number'] ) ? esc_attr( $_POST['account_number'] ) : $saved_data['account_number'];
		$phone_number   = isset( $_POST['phone_number'] ) ? esc_attr( $_POST['phone_number'] ) : $saved_data['phone_number'];
		?>
		<tr class="form-row form-required">
			<th scope="row">
				<label for="bank_name"><?php _e( 'Bank Name', 'aff_bd' ); ?></label>
			</th>

			<td>
				<input class="regular-text" type="text" name="bank_name" id="bank_name" value="<?php echo esc_attr( $bank_name ); ?>"/>
				<p class="description"><?php _e( 'Affiliate\'s bank name', 'affiliate-wp' ); ?></p>
			</td>
		</tr>
		<tr class="form-row form-required">
			<th scope="row">
				<label for="account_name"><?php _e( 'Account Name', 'aff_bd' ); ?></label>
			</th>

			<td>
				<input class="regular-text" type="text" name="account_name" id="account_name" value="<?php echo esc_attr( $account_name ); ?>"/>
				<p class="description"><?php _e( 'Affiliate\'s bank account name', 'affiliate-wp' ); ?></p>
			</td>
		</tr>
		<tr class="form-row form-required">
			<th scope="row">
				<label for="account_number"><?php _e( 'Account Number', 'aff_bd' ); ?></label>
			</th>
			<td>
				<input class="regular-text" type="text" name="account_number" id="account_number" value="<?php echo esc_attr( $account_number ); ?>"/>
				<p class="description"><?php _e( 'Affiliate\'s bank account number', 'affiliate-wp' ); ?></p>
			</td>
		</tr>
		<tr class="form-row form-required">
			<th scope="row">
				<label for="phone_number"><?php _e( 'Account Number', 'aff_bd' ); ?></label>
			</th>
			<td>
				<input class="regular-text" type="text" name="phone_number" id="phone_number" value="<?php echo esc_attr( $phone_number ); ?>"/>
				<p class="description"><?php _e( 'Affiliate\'s phone number', 'affiliate-wp' ); ?></p>
			</td>
		</tr>
	<?php }

	public function affwp_process_update_affiliate() {
		echo 'run update here'; exit;
	}
}

new Aff_Bank_Details();