<?php
/**
 * geoPins Custom Post Type
 * Plugin Name: geo-pins-data-input
 * Plugin URI:  http://github.com/bonjourworld/jr-wp-data-input-plugin
 * Description: Creates a custom post type and enables custom data input saving by creating WP metaboxes
 * Version:     1.0.0
 * Author:      James Roussel
 * Author URI:  http://github.com/bonjourworld
 * Text Domain: geoPin-post-type
 */


/**
 * Register metaboxes
 */
class Geopin_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'geopin_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );

	}

	public function geopin_meta_boxes() {
		add_meta_box(
			'geopin_fields',
			'geopin Fields',
			array( $this, 'render_meta_boxes' ),
			'geopin',
			'normal',
			'high'
		);
	}

   /**
	* HTML form for special fields
	*/
	function render_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		$country = ! isset( $meta['pin_country'][0] ) ? '' : $meta['pin_country'][0];
		$latitude = ! isset( $meta['pin_latitude'][0] ) ? '' : $meta['pin_latitude'][0];
		$longitude = ! isset( $meta['pin_longitude'][0] ) ? '' : $meta['pin_longitude'][0];
		$zoomlevel = ! isset( $meta['pin_zoom_level'][0] ) ? '' : $meta['pin_zoom_level'][0];
		$title = ! isset( $meta['pin_title'][0] ) ? '' : $meta['pin_title'][0];
		$nameid= ! isset( $meta['pin_name'][0] ) ? '' : $meta['pin_name'][0];
		$direction = ! isset( $meta['pin_direction'][0] ) ? '' : $meta['pin_direction'][0];

		wp_nonce_field( basename( __FILE__ ), 'geopin_fields' ); ?>

		<table class="form-table">

			<tr>
				<td class="geopin_meta_box_td" colspan="2">
					<label for="pin_country"><?php _e( 'Country', 'geopin-post-type' ); ?>
					</label>
				</td>
				<td colspan="4">
			        <select name='pin_country'>
			        	<option value="CA" <?php selected($country, 'CA'); ?>>Canada</option>  <!--put here your default country :) -->
						<option value="AF" <?php selected($country, 'AF'); ?>>Afghanistan</option>
						<option value="AX" <?php selected($country, 'AX'); ?>>Åland Islands</option>
						<option value="AL" <?php selected($country, 'AL'); ?>>Albania</option>
						<option value="DZ" <?php selected($country, 'DZ'); ?>>Algeria</option>
						<option value="AS" <?php selected($country, 'AS'); ?>>American Samoa</option>
						<option value="AD" <?php selected($country, 'AD'); ?>>Andorra</option>
						<option value="AO" <?php selected($country, 'AO'); ?>>Angola</option>
						<option value="AI" <?php selected($country, 'AI'); ?>>Anguilla</option>
						<option value="AQ" <?php selected($country, 'AQ'); ?>>Antarctica</option>
						<option value="AG" <?php selected($country, 'AG'); ?>>Antigua and Barbuda</option>
						<option value="AR" <?php selected($country, 'AR'); ?>>Argentina</option>
						<option value="AM" <?php selected($country, 'AM'); ?>>Armenia</option>
						<option value="AW" <?php selected($country, 'AW'); ?>>Aruba</option>
						<option value="AU" <?php selected($country, 'AU'); ?>>Australia</option>
						<option value="AT" <?php selected($country, 'AT'); ?>>Austria</option>
						<option value="AZ" <?php selected($country, 'AZ'); ?>>Azerbaijan</option>
						<option value="BS" <?php selected($country, 'BS'); ?>>Bahamas</option>
						<option value="BH" <?php selected($country, 'BH'); ?>>Bahrain</option>
						<option value="BD" <?php selected($country, 'BD'); ?>>Bangladesh</option>
						<option value="BB" <?php selected($country, 'BB'); ?>>Barbados</option>
						<option value="BY" <?php selected($country, 'BY'); ?>>Belarus</option>
						<option value="BE" <?php selected($country, 'BE'); ?>>Belgium</option>
						<option value="BZ" <?php selected($country, 'BZ'); ?>>Belize</option>
						<option value="BJ" <?php selected($country, 'BJ'); ?>>Benin</option>
						<option value="BM" <?php selected($country, 'BM'); ?>>Bermuda</option>
						<option value="BT" <?php selected($country, 'BT'); ?>>Bhutan</option>
						<option value="BO" <?php selected($country, 'BO'); ?>>Bolivia</option>
						<option value="BA" <?php selected($country, 'BA'); ?>>Bosnia and Herzegovina</option>
						<option value="BW" <?php selected($country, 'BW'); ?>>Botswana</option>
						<option value="BV" <?php selected($country, 'BV'); ?>>Bouvet Island</option>
						<option value="BR" <?php selected($country, 'BR'); ?>>Brazil</option>
						<option value="IO" <?php selected($country, 'IO'); ?>>British Indian Ocean Territory</option>
						<option value="BN" <?php selected($country, 'BN'); ?>>Brunei Darussalam</option>
						<option value="BG" <?php selected($country, 'BG'); ?>>Bulgaria</option>
						<option value="BF" <?php selected($country, 'BF'); ?>>Burkina Faso</option>
						<option value="BI" <?php selected($country, 'BI'); ?>>Burundi</option>
						<option value="KH" <?php selected($country, 'KH'); ?>>Cambodia</option>
						<option value="CM" <?php selected($country, 'CM'); ?>>Cameroon</option>
						<option value="CV" <?php selected($country, 'CV'); ?>>Cape Verde</option>
						<option value="KY" <?php selected($country, 'KY'); ?>>Cayman Islands</option>
						<option value="CF" <?php selected($country, 'CF'); ?>>Central African Republic</option>
						<option value="TD" <?php selected($country, 'TD'); ?>>Chad</option>
						<option value="CL" <?php selected($country, 'CL'); ?>>Chile</option>
						<option value="CN" <?php selected($country, 'CN'); ?>>China</option>
						<option value="CX" <?php selected($country, 'CX'); ?>>Christmas Island</option>
						<option value="CC" <?php selected($country, 'CC'); ?>>Cocos (Keeling) Islands</option>
						<option value="CO" <?php selected($country, 'CO'); ?>>Colombia</option>
						<option value="KM" <?php selected($country, 'KM'); ?>>Comoros</option>
						<option value="CG" <?php selected($country, 'CG'); ?>>Congo</option>
						<option value="CD" <?php selected($country, 'CD'); ?>>Congo, The Democratic Republic of The</option>
						<option value="CK" <?php selected($country, 'CK'); ?>>Cook Islands</option>
						<option value="CR" <?php selected($country, 'CR'); ?>>Costa Rica</option>
						<option value="CI" <?php selected($country, 'CI'); ?>>Cote D'ivoire</option>
						<option value="HR" <?php selected($country, 'HR'); ?>>Croatia</option>
						<option value="CU" <?php selected($country, 'CU'); ?>>Cuba</option>
						<option value="CY" <?php selected($country, 'CY'); ?>>Cyprus</option>
						<option value="CZ" <?php selected($country, 'CZ'); ?>>Czech Republic</option>
						<option value="DK" <?php selected($country, 'DK'); ?>>Denmark</option>
						<option value="DJ" <?php selected($country, 'DJ'); ?>>Djibouti</option>
						<option value="DM" <?php selected($country, 'DM'); ?>>Dominica</option>
						<option value="DO" <?php selected($country, 'DO'); ?>>Dominican Republic</option>
						<option value="EC" <?php selected($country, 'EC'); ?>>Ecuador</option>
						<option value="EG" <?php selected($country, 'EG'); ?>>Egypt</option>
						<option value="SV" <?php selected($country, 'SV'); ?>>El Salvador</option>
						<option value="GQ" <?php selected($country, 'GQ'); ?>>Equatorial Guinea</option>
						<option value="ER" <?php selected($country, 'ER'); ?>>Eritrea</option>
						<option value="EE" <?php selected($country, 'EE'); ?>>Estonia</option>
						<option value="ET" <?php selected($country, 'ET'); ?>>Ethiopia</option>
						<option value="FK" <?php selected($country, 'FK'); ?>>Falkland Islands (Malvinas)</option>
						<option value="FO" <?php selected($country, 'FO'); ?>>Faroe Islands</option>
						<option value="FJ" <?php selected($country, 'FJ'); ?>>Fiji</option>
						<option value="FI" <?php selected($country, 'FI'); ?>>Finland</option>
						<option value="FR" <?php selected($country, 'FR'); ?>>France</option>
						<option value="GF" <?php selected($country, 'GF'); ?>>French Guiana</option>
						<option value="PF" <?php selected($country, 'PF'); ?>>French Polynesia</option>
						<option value="TF" <?php selected($country, 'TF'); ?>>French Southern Territories</option>
						<option value="GA" <?php selected($country, 'GA'); ?>>Gabon</option>
						<option value="GM" <?php selected($country, 'GM'); ?>>Gambia</option>
						<option value="GE" <?php selected($country, 'GE'); ?>>Georgia</option>
						<option value="DE" <?php selected($country, 'DE'); ?>>Germany</option>
						<option value="GH" <?php selected($country, 'GH'); ?>>Ghana</option>
						<option value="GI" <?php selected($country, 'GI'); ?>>Gibraltar</option>
						<option value="GR" <?php selected($country, 'GR'); ?>>Greece</option>
						<option value="GL" <?php selected($country, 'GL'); ?>>Greenland</option>
						<option value="GD" <?php selected($country, 'GD'); ?>>Grenada</option>
						<option value="GP" <?php selected($country, 'GP'); ?>>Guadeloupe</option>
						<option value="GU" <?php selected($country, 'GU'); ?>>Guam</option>
						<option value="GT" <?php selected($country, 'GT'); ?>>Guatemala</option>
						<option value="GG" <?php selected($country, 'GG'); ?>>Guernsey</option>
						<option value="GN" <?php selected($country, 'GN'); ?>>Guinea</option>
						<option value="GW" <?php selected($country, 'GW'); ?>>Guinea-bissau</option>
						<option value="GY" <?php selected($country, 'GY'); ?>>Guyana</option>
						<option value="HT" <?php selected($country, 'HT'); ?>>Haiti</option>
						<option value="HM" <?php selected($country, 'HM'); ?>>Heard Island and Mcdonald Islands</option>
						<option value="VA" <?php selected($country, 'VA'); ?>>Holy See (Vatican City State)</option>
						<option value="HN" <?php selected($country, 'HN'); ?>>Honduras</option>
						<option value="HK" <?php selected($country, 'HK'); ?>>Hong Kong</option>
						<option value="HU" <?php selected($country, 'HU'); ?>>Hungary</option>
						<option value="IS" <?php selected($country, 'IS'); ?>>Iceland</option>
						<option value="IN" <?php selected($country, 'IN'); ?>>India</option>
						<option value="ID" <?php selected($country, 'ID'); ?>>Indonesia</option>
						<option value="IR" <?php selected($country, 'IR'); ?>>Iran, Islamic Republic of</option>
						<option value="IQ" <?php selected($country, 'IQ'); ?>>Iraq</option>
						<option value="IE" <?php selected($country, 'IE'); ?>>Ireland</option>
						<option value="IM" <?php selected($country, 'IM'); ?>>Isle of Man</option>
						<option value="IL" <?php selected($country, 'IL'); ?>>Israel</option>
						<option value="IT" <?php selected($country, 'IT'); ?>>Italy</option>
						<option value="JM" <?php selected($country, 'JM'); ?>>Jamaica</option>
						<option value="JP" <?php selected($country, 'JP'); ?>>Japan</option>
						<option value="JE" <?php selected($country, 'JE'); ?>>Jersey</option>
						<option value="JO" <?php selected($country, 'JO'); ?>>Jordan</option>
						<option value="KZ" <?php selected($country, 'KZ'); ?>>Kazakhstan</option>
						<option value="KE" <?php selected($country, 'KE'); ?>>Kenya</option>
						<option value="KI" <?php selected($country, 'KI'); ?>>Kiribati</option>
						<option value="KP" <?php selected($country, 'KP'); ?>>Korea, Democratic People's Republic of</option>
						<option value="KR" <?php selected($country, 'KR'); ?>>Korea, Republic of</option>
						<option value="KW" <?php selected($country, 'KW'); ?>>Kuwait</option>
						<option value="KG" <?php selected($country, 'KG'); ?>>Kyrgyzstan</option>
						<option value="LA" <?php selected($country, 'LA'); ?>>Lao People's Democratic Republic</option>
						<option value="LV" <?php selected($country, 'LV'); ?>>Latvia</option>
						<option value="LB" <?php selected($country, 'LB'); ?>>Lebanon</option>
						<option value="LS" <?php selected($country, 'LS'); ?>>Lesotho</option>
						<option value="LR" <?php selected($country, 'LR'); ?>>Liberia</option>
						<option value="LY" <?php selected($country, 'LY'); ?>>Libyan Arab Jamahiriya</option>
						<option value="LI" <?php selected($country, 'LI'); ?>>Liechtenstein</option>
						<option value="LT" <?php selected($country, 'LT'); ?>>Lithuania</option>
						<option value="LU" <?php selected($country, 'LU'); ?>>Luxembourg</option>
						<option value="MO" <?php selected($country, 'MO'); ?>>Macao</option>
						<option value="MK" <?php selected($country, 'MK'); ?>>Macedonia, The Former Yugoslav Republic of</option>
						<option value="MG" <?php selected($country, 'MG'); ?>>Madagascar</option>
						<option value="MW" <?php selected($country, 'MW'); ?>>Malawi</option>
						<option value="MY" <?php selected($country, 'MY'); ?>>Malaysia</option>
						<option value="MV" <?php selected($country, 'MV'); ?>>Maldives</option>
						<option value="ML" <?php selected($country, 'ML'); ?>>Mali</option>
						<option value="MT" <?php selected($country, 'MT'); ?>>Malta</option>
						<option value="MH" <?php selected($country, 'MH'); ?>>Marshall Islands</option>
						<option value="MQ" <?php selected($country, 'MQ'); ?>>Martinique</option>
						<option value="MR" <?php selected($country, 'MR'); ?>>Mauritania</option>
						<option value="MU" <?php selected($country, 'MU'); ?>>Mauritius</option>
						<option value="YT" <?php selected($country, 'YT'); ?>>Mayotte</option>
						<option value="MX" <?php selected($country, 'MX'); ?>>Mexico</option>
						<option value="FM" <?php selected($country, 'FM'); ?>>Micronesia, Federated States of</option>
						<option value="MD" <?php selected($country, 'MD'); ?>>Moldova, Republic of</option>
						<option value="MC" <?php selected($country, 'MC'); ?>>Monaco</option>
						<option value="MN" <?php selected($country, 'MN'); ?>>Mongolia</option>
						<option value="ME" <?php selected($country, 'ME'); ?>>Montenegro</option>
						<option value="MS" <?php selected($country, 'MS'); ?>>Montserrat</option>
						<option value="MA" <?php selected($country, 'MA'); ?>>Morocco</option>
						<option value="MZ" <?php selected($country, 'MZ'); ?>>Mozambique</option>
						<option value="MM" <?php selected($country, 'MM'); ?>>Myanmar</option>
						<option value="NA" <?php selected($country, 'NA'); ?>>Namibia</option>
						<option value="NR" <?php selected($country, 'NR'); ?>>Nauru</option>
						<option value="NP" <?php selected($country, 'NP'); ?>>Nepal</option>
						<option value="NL" <?php selected($country, 'NL'); ?>>Netherlands</option>
						<option value="AN" <?php selected($country, 'AN'); ?>>Netherlands Antilles</option>
						<option value="NC" <?php selected($country, 'NC'); ?>>New Caledonia</option>
						<option value="NZ" <?php selected($country, 'NZ'); ?>>New Zealand</option>
						<option value="NI" <?php selected($country, 'NI'); ?>>Nicaragua</option>
						<option value="NE" <?php selected($country, 'NE'); ?>>Niger</option>
						<option value="NG" <?php selected($country, 'NG'); ?>>Nigeria</option>
						<option value="NU" <?php selected($country, 'NU'); ?>>Niue</option>
						<option value="NF" <?php selected($country, 'NF'); ?>>Norfolk Island</option>
						<option value="MP" <?php selected($country, 'MP'); ?>>Northern Mariana Islands</option>
						<option value="NO" <?php selected($country, 'NO'); ?>>Norway</option>
						<option value="OM" <?php selected($country, 'OM'); ?>>Oman</option>
						<option value="PK" <?php selected($country, 'PK'); ?>>Pakistan</option>
						<option value="PW" <?php selected($country, 'PW'); ?>>Palau</option>
						<option value="PS" <?php selected($country, 'PS'); ?>>Palestinian Territory, Occupied</option>
						<option value="PA" <?php selected($country, 'PA'); ?>>Panama</option>
						<option value="PG" <?php selected($country, 'PG'); ?>>Papua New Guinea</option>
						<option value="PY" <?php selected($country, 'PY'); ?>>Paraguay</option>
						<option value="PE" <?php selected($country, 'PE'); ?>>Peru</option>
						<option value="PH" <?php selected($country, 'PH'); ?>>Philippines</option>
						<option value="PN" <?php selected($country, 'PN'); ?>>Pitcairn</option>
						<option value="PL" <?php selected($country, 'PL'); ?>>Poland</option>
						<option value="PT" <?php selected($country, 'PT'); ?>>Portugal</option>
						<option value="PR" <?php selected($country, 'PR'); ?>>Puerto Rico</option>
						<option value="QA" <?php selected($country, 'QA'); ?>>Qatar</option>
						<option value="RE" <?php selected($country, 'RE'); ?>>Reunion</option>
						<option value="RO" <?php selected($country, 'RO'); ?>>Romania</option>
						<option value="RU" <?php selected($country, 'RU'); ?>>Russian Federation</option>
						<option value="RW" <?php selected($country, 'RW'); ?>>Rwanda</option>
						<option value="SH" <?php selected($country, 'SH'); ?>>Saint Helena</option>
						<option value="KN" <?php selected($country, 'KN'); ?>>Saint Kitts and Nevis</option>
						<option value="LC" <?php selected($country, 'LC'); ?>>Saint Lucia</option>
						<option value="PM" <?php selected($country, 'PM'); ?>>Saint Pierre and Miquelon</option>
						<option value="VC" <?php selected($country, 'VC'); ?>>Saint Vincent and The Grenadines</option>
						<option value="WS" <?php selected($country, 'WS'); ?>>Samoa</option>
						<option value="SM" <?php selected($country, 'SM'); ?>>San Marino</option>
						<option value="ST" <?php selected($country, 'ST'); ?>>Sao Tome and Principe</option>
						<option value="SA" <?php selected($country, 'SA'); ?>>Saudi Arabia</option>
						<option value="SN" <?php selected($country, 'SN'); ?>>Senegal</option>
						<option value="RS" <?php selected($country, 'RS'); ?>>Serbia</option>
						<option value="SC" <?php selected($country, 'SC'); ?>>Seychelles</option>
						<option value="SL" <?php selected($country, 'SL'); ?>>Sierra Leone</option>
						<option value="SG" <?php selected($country, 'SG'); ?>>Singapore</option>
						<option value="SK" <?php selected($country, 'SK'); ?>>Slovakia</option>
						<option value="SI" <?php selected($country, 'SI'); ?>>Slovenia</option>
						<option value="SB" <?php selected($country, 'SB'); ?>>Solomon Islands</option>
						<option value="SO" <?php selected($country, 'SO'); ?>>Somalia</option>
						<option value="ZA" <?php selected($country, 'ZA'); ?>>South Africa</option>
						<option value="GS" <?php selected($country, 'GS'); ?>>South Georgia and The South Sandwich Islands</option>
						<option value="ES" <?php selected($country, 'ES'); ?>>Spain</option>
						<option value="LK" <?php selected($country, 'LK'); ?>>Sri Lanka</option>
						<option value="SD" <?php selected($country, 'SD'); ?>>Sudan</option>
						<option value="SR" <?php selected($country, 'SR'); ?>>Suriname</option>
						<option value="SJ" <?php selected($country, 'SJ'); ?>>Svalbard and Jan Mayen</option>
						<option value="SZ" <?php selected($country, 'SZ'); ?>>Swaziland</option>
						<option value="SE" <?php selected($country, 'SE'); ?>>Sweden</option>
						<option value="CH" <?php selected($country, 'CH'); ?>>Switzerland</option>
						<option value="SY" <?php selected($country, 'SY'); ?>>Syrian Arab Republic</option>
						<option value="TW" <?php selected($country, 'TW'); ?>>Taiwan, Province of China</option>
						<option value="TJ" <?php selected($country, 'TJ'); ?>>Tajikistan</option>
						<option value="TZ" <?php selected($country, 'TZ'); ?>>Tanzania, United Republic of</option>
						<option value="TH" <?php selected($country, 'TH'); ?>>Thailand</option>
						<option value="TL" <?php selected($country, 'TL'); ?>>Timor-leste</option>
						<option value="TG" <?php selected($country, 'TG'); ?>>Togo</option>
						<option value="TK" <?php selected($country, 'TK'); ?>>Tokelau</option>
						<option value="TO" <?php selected($country, 'TO'); ?>>Tonga</option>
						<option value="TT" <?php selected($country, 'TT'); ?>>Trinidad and Tobago</option>
						<option value="TN" <?php selected($country, 'TN'); ?>>Tunisia</option>
						<option value="TR" <?php selected($country, 'TR'); ?>>Turkey</option>
						<option value="TM" <?php selected($country, 'TM'); ?>>Turkmenistan</option>
						<option value="TC" <?php selected($country, 'TC'); ?>>Turks and Caicos Islands</option>
						<option value="TV" <?php selected($country, 'TV'); ?>>Tuvalu</option>
						<option value="UG" <?php selected($country, 'UG'); ?>>Uganda</option>
						<option value="UA" <?php selected($country, 'UA'); ?>>Ukraine</option>
						<option value="AE" <?php selected($country, 'AE'); ?>>United Arab Emirates</option>
						<option value="GB" <?php selected($country, 'GB'); ?>>United Kingdom</option>
						<option value="US" <?php selected($country, 'US'); ?>>United States</option>
						<option value="UM" <?php selected($country, 'UM'); ?>>United States Minor Outlying Islands</option>
						<option value="UY" <?php selected($country, 'UY'); ?>>Uruguay</option>
						<option value="UZ" <?php selected($country, 'UZ'); ?>>Uzbekistan</option>
						<option value="VU" <?php selected($country, 'VU'); ?>>Vanuatu</option>
						<option value="VE" <?php selected($country, 'VE'); ?>>Venezuela</option>
						<option value="VN" <?php selected($country, 'VN'); ?>>Viet Nam</option>
						<option value="VG" <?php selected($country, 'VG'); ?>>Virgin Islands, British</option>
						<option value="VI" <?php selected($country, 'VI'); ?>>Virgin Islands, U.S.</option>
						<option value="WF" <?php selected($country, 'WF'); ?>>Wallis and Futuna</option>
						<option value="EH" <?php selected($country, 'EH'); ?>>Western Sahara</option>
						<option value="YE" <?php selected($country, 'YE'); ?>>Yemen</option>
						<option value="ZM" <?php selected($country, 'ZM'); ?>>Zambia</option>
						<option value="ZW" <?php selected($country, 'ZW'); ?>>Zimbabwe</option>
					</select>
	    		</td>
			</tr>

			<tr>
				<td class="geopin_meta_box_td" colspan="2">
					<label for="pin_latitude"><?php _e( 'Latitude', 'geopin-post-type' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="pin_latitude" class="regular-text" value="<?php echo $latitude; ?>">
				</td>
			</tr>

			<tr>
				<td class="geopin_meta_box_td" colspan="2">
					<label for="pin_longitude"><?php _e( 'Longitude', 'geopin-post-type' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="pin_longitude" class="regular-text" value="<?php echo $longitude; ?>">
				</td>
			</tr>

			<tr>
				<td class="geopin_meta_box_td" colspan="2">
					<label for="pin_zoom_level"><?php _e( 'Zoom Level', 'geopin-post-type' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="pin_zoom_level" class="regular-text" value="<?php echo $zoomlevel; ?>">
				</td>
			</tr>


			<tr>
				<td class="geopin_meta_box_td" colspan="2">
					<label for="pin_title"><?php _e( 'Title', 'geopin-post-type' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="pin_title" class="regular-text" value="<?php echo $title; ?>">
					<p class="description"><?php _e( 'E.g. Beautiful Toronto Landscape, Rome, Empire State', 'geopin-post-type' ); ?></p>
				</td>
			</tr>

			<tr>
				<td class="geopin_meta_box_td" colspan="2">
					<label for="pin_name"><?php _e( 'Name', 'geopin-post-type' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="pin_name" class="regular-text" value="<?php echo $nameid; ?>">
					<p class="description"><?php _e( 'E.g. John Doe', 'geopin-post-type' ); ?></p>
				</td>
			</tr>

			<tr>
				<td class="geopin_meta_box_td" colspan="2">
					<label for="pin_direction"><?php _e( 'Sent / Received', 'geopin-post-type' ); ?>
					</label>
				</td>
				<td colspan="4">
        				<input type="radio" name="pin_direction" value="Sent" <?php echo ($direction == 'Sent')? 'checked="checked"':''; ?>/> Sent<br />
       				   	<input type="radio" name="pin_direction" value="Received" <?php echo ($direction== 'Received')? 'checked="checked"':''; ?>/> Received<br />
				 </td>
			</tr>





		</table>

	<?php }

   /**
	* Save metaboxes
	*/
	function save_meta_boxes( $post_id ) {

		global $post;

		// Verify nonce
		if ( !isset( $_POST['geopin_fields'] ) || !wp_verify_nonce( $_POST['geopin_fields'], basename(__FILE__) ) ) {
			return $post_id;
		}

		// Check Autosave
		if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']) ) {
			return $post_id;
		}

		// Don't save if only a revision
		if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
			return $post_id;
		}

		// Check permissions
		if ( !current_user_can( 'edit_post', $post->ID ) ) {
			return $post_id;
		}
        
		//Checks if the values are set, otherwise the input is sanitized by only allowing TEXT :) 

		$meta['pin_country'] = ( isset( $_POST['pin_country'] ) ? esc_textarea( $_POST['pin_country'] ) : '' );

		$meta['pin_latitude'] = ( isset( $_POST['pin_latitude'] ) ? esc_textarea( $_POST['pin_latitude'] ) : '' );

		$meta['pin_longitude'] = ( isset( $_POST['pin_longitude'] ) ? esc_textarea( $_POST['pin_longitude'] ) : '' );

		$meta['pin_zoom_level'] = ( isset( $_POST['pin_zoom_level'] ) ? esc_textarea( $_POST['pin_zoom_level'] ) : '' );

		$meta['pin_title'] = ( isset( $_POST['pin_title'] ) ? esc_textarea( $_POST['pin_title'] ) : '' );

		$meta['pin_name'] = ( isset( $_POST['pin_name'] ) ? esc_textarea( $_POST['pin_name'] ) : '' );

		$meta['pin_direction'] = ( isset( $_POST['pin_direction'] ) ? esc_textarea( $_POST['pin_direction'] ) : '' );

		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}
 

}