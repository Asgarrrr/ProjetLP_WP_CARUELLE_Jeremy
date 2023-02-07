<?php

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

class JC_ProjetLP_Install {

    public function __construct() {

    }

    public function tableAlreadyExists( $table_name = '' ) {

        global $wpdb;

        if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name )
            return true;

        return false;

    }

    public function setup() {

        // On vérifie si la table existe déjà, si oui, on ne fait rien, sinon on la crée

        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $table_country_name = $wpdb->prefix . 'projetlp_country';

        if ( $this->tableAlreadyExists( $table_country_name ) ) {

            $wpdb->query( "DROP TABLE IF EXISTS $table_country_name" );

        }


        if ( !$this->tableAlreadyExists( $table_country_name ) ) {

            $sql = "CREATE TABLE $table_country_name (
                ISO             varchar(3)      NOT NULL,
                countryNameFR   varchar(255)    NOT NULL,
                notation        int(1)          NOT NULL DEFAULT 0,
                majorOnly       int(1)          NOT NULL DEFAULT 0,
                PRIMARY KEY  (ISO)
            ) $charset_collate;";

            dbDelta( $sql );

            // Populate table
            $iso_array = array(
                'ABW'=>'Aruba',
                'AFG'=>'Afghanistan',
                'AGO'=>'Angola',
                'AIA'=>'Anguilla',
                'ALA'=>'Åland Islands',
                'ALB'=>'Albania',
                'AND'=>'Andorra',
                'ARE'=>'United Arab Emirates',
                'ARG'=>'Argentina',
                'ARM'=>'Armenia',
                'ASM'=>'American Samoa',
                'ATA'=>'Antarctica',
                'ATF'=>'French Southern Territories',
                'ATG'=>'Antigua and Barbuda',
                'AUS'=>'Australia',
                'AUT'=>'Austria',
                'AZE'=>'Azerbaijan',
                'BDI'=>'Burundi',
                'BEL'=>'Belgium',
                'BEN'=>'Benin',
                'BES'=>'Bonaire, Sint Eustatius and Saba',
                'BFA'=>'Burkina Faso',
                'BGD'=>'Bangladesh',
                'BGR'=>'Bulgaria',
                'BHR'=>'Bahrain',
                'BHS'=>'Bahamas',
                'BIH'=>'Bosnia and Herzegovina',
                'BLM'=>'Saint Barthélemy',
                'BLR'=>'Belarus',
                'BLZ'=>'Belize',
                'BMU'=>'Bermuda',
                'BOL'=>'Bolivia, Plurinational State of',
                'BRA'=>'Brazil',
                'BRB'=>'Barbados',
                'BRN'=>'Brunei Darussalam',
                'BTN'=>'Bhutan',
                'BVT'=>'Bouvet Island',
                'BWA'=>'Botswana',
                'CAF'=>'Central African Republic',
                'CAN'=>'Canada',
                'CCK'=>'Cocos (Keeling) Islands',
                'CHE'=>'Switzerland',
                'CHL'=>'Chile',
                'CHN'=>'China',
                'CIV'=>'Côte d\'Ivoire',
                'CMR'=>'Cameroon',
                'COD'=>'Congo, the Democratic Republic of the',
                'COG'=>'Congo',
                'COK'=>'Cook Islands',
                'COL'=>'Colombia',
                'COM'=>'Comoros',
                'CPV'=>'Cape Verde',
                'CRI'=>'Costa Rica',
                'CUB'=>'Cuba',
                'CUW'=>'Curaçao',
                'CXR'=>'Christmas Island',
                'CYM'=>'Cayman Islands',
                'CYP'=>'Cyprus',
                'CZE'=>'Czech Republic',
                'DEU'=>'Germany',
                'DJI'=>'Djibouti',
                'DMA'=>'Dominica',
                'DNK'=>'Denmark',
                'DOM'=>'Dominican Republic',
                'DZA'=>'Algeria',
                'ECU'=>'Ecuador',
                'EGY'=>'Egypt',
                'ERI'=>'Eritrea',
                'ESH'=>'Western Sahara',
                'ESP'=>'Spain',
                'EST'=>'Estonia',
                'ETH'=>'Ethiopia',
                'FIN'=>'Finland',
                'FJI'=>'Fiji',
                'FLK'=>'Falkland Islands (Malvinas)',
                'FRA'=>'France',
                'FRO'=>'Faroe Islands',
                'FSM'=>'Micronesia, Federated States of',
                'GAB'=>'Gabon',
                'GBR'=>'United Kingdom',
                'GEO'=>'Georgia',
                'GGY'=>'Guernsey',
                'GHA'=>'Ghana',
                'GIB'=>'Gibraltar',
                'GIN'=>'Guinea',
                'GLP'=>'Guadeloupe',
                'GMB'=>'Gambia',
                'GNB'=>'Guinea-Bissau',
                'GNQ'=>'Equatorial Guinea',
                'GRC'=>'Greece',
                'GRD'=>'Grenada',
                'GRL'=>'Greenland',
                'GTM'=>'Guatemala',
                'GUF'=>'French Guiana',
                'GUM'=>'Guam',
                'GUY'=>'Guyana',
                'HKG'=>'Hong Kong',
                'HMD'=>'Heard Island and McDonald Islands',
                'HND'=>'Honduras',
                'HRV'=>'Croatia',
                'HTI'=>'Haiti',
                'HUN'=>'Hungary',
                'IDN'=>'Indonesia',
                'IMN'=>'Isle of Man',
                'IND'=>'India',
                'IOT'=>'British Indian Ocean Territory',
                'IRL'=>'Ireland',
                'IRN'=>'Iran, Islamic Republic of',
                'IRQ'=>'Iraq',
                'ISL'=>'Iceland',
                'ISR'=>'Israel',
                'ITA'=>'Italy',
                'JAM'=>'Jamaica',
                'JEY'=>'Jersey',
                'JOR'=>'Jordan',
                'JPN'=>'Japan',
                'KAZ'=>'Kazakhstan',
                'KEN'=>'Kenya',
                'KGZ'=>'Kyrgyzstan',
                'KHM'=>'Cambodia',
                'KIR'=>'Kiribati',
                'KNA'=>'Saint Kitts and Nevis',
                'KOR'=>'Korea, Republic of',
                'KWT'=>'Kuwait',
                'LAO'=>'Lao People\'s Democratic Republic',
                'LBN'=>'Lebanon',
                'LBR'=>'Liberia',
                'LBY'=>'Libya',
                'LCA'=>'Saint Lucia',
                'LIE'=>'Liechtenstein',
                'LKA'=>'Sri Lanka',
                'LSO'=>'Lesotho',
                'LTU'=>'Lithuania',
                'LUX'=>'Luxembourg',
                'LVA'=>'Latvia',
                'MAC'=>'Macao',
                'MAF'=>'Saint Martin (French part)',
                'MAR'=>'Morocco',
                'MCO'=>'Monaco',
                'MDA'=>'Moldova, Republic of',
                'MDG'=>'Madagascar',
                'MDV'=>'Maldives',
                'MEX'=>'Mexico',
                'MHL'=>'Marshall Islands',
                'MKD'=>'Macedonia, the former Yugoslav Republic of',
                'MLI'=>'Mali',
                'MLT'=>'Malta',
                'MMR'=>'Myanmar',
                'MNE'=>'Montenegro',
                'MNG'=>'Mongolia',
                'MNP'=>'Northern Mariana Islands',
                'MOZ'=>'Mozambique',
                'MRT'=>'Mauritania',
                'MSR'=>'Montserrat',
                'MTQ'=>'Martinique',
                'MUS'=>'Mauritius',
                'MWI'=>'Malawi',
                'MYS'=>'Malaysia',
                'MYT'=>'Mayotte',
                'NAM'=>'Namibia',
                'NCL'=>'New Caledonia',
                'NER'=>'Niger',
                'NFK'=>'Norfolk Island',
                'NGA'=>'Nigeria',
                'NIC'=>'Nicaragua',
                'NIU'=>'Niue',
                'NLD'=>'Netherlands',
                'NOR'=>'Norway',
                'NPL'=>'Nepal',
                'NRU'=>'Nauru',
                'NZL'=>'New Zealand',
                'OMN'=>'Oman',
                'PAK'=>'Pakistan',
                'PAN'=>'Panama',
                'PCN'=>'Pitcairn',
                'PER'=>'Peru',
                'PHL'=>'Philippines',
                'PLW'=>'Palau',
                'PNG'=>'Papua New Guinea',
                'POL'=>'Poland',
                'PRI'=>'Puerto Rico',
                'PRK'=>'Korea, Democratic People\'s Republic of',
                'PRT'=>'Portugal',
                'PRY'=>'Paraguay',
                'PSE'=>'Palestinian Territory, Occupied',
                'PYF'=>'French Polynesia',
                'QAT'=>'Qatar',
                'REU'=>'Réunion',
                'ROU'=>'Romania',
                'RUS'=>'Russian Federation',
                'RWA'=>'Rwanda',
                'SAU'=>'Saudi Arabia',
                'SDN'=>'Sudan',
                'SEN'=>'Senegal',
                'SGP'=>'Singapore',
                'SGS'=>'South Georgia and the South Sandwich Islands',
                'SHN'=>'Saint Helena, Ascension and Tristan da Cunha',
                'SJM'=>'Svalbard and Jan Mayen',
                'SLB'=>'Solomon Islands',
                'SLE'=>'Sierra Leone',
                'SLV'=>'El Salvador',
                'SMR'=>'San Marino',
                'SOM'=>'Somalia',
                'SPM'=>'Saint Pierre and Miquelon',
                'SRB'=>'Serbia',
                'SSD'=>'South Sudan',
                'STP'=>'Sao Tome and Principe',
                'SUR'=>'Suriname',
                'SVK'=>'Slovakia',
                'SVN'=>'Slovenia',
                'SWE'=>'Sweden',
                'SWZ'=>'Swaziland',
                'SXM'=>'Sint Maarten (Dutch part)',
                'SYC'=>'Seychelles',
                'SYR'=>'Syrian Arab Republic',
                'TCA'=>'Turks and Caicos Islands',
                'TCD'=>'Chad',
                'TGO'=>'Togo',
                'THA'=>'Thailand',
                'TJK'=>'Tajikistan',
                'TKL'=>'Tokelau',
                'TKM'=>'Turkmenistan',
                'TLS'=>'Timor-Leste',
                'TON'=>'Tonga',
                'TTO'=>'Trinidad and Tobago',
                'TUN'=>'Tunisia',
                'TUR'=>'Turkey',
                'TUV'=>'Tuvalu',
                'TWN'=>'Taiwan, Province of China',
                'TZA'=>'Tanzania, United Republic of',
                'UGA'=>'Uganda',
                'UKR'=>'Ukraine',
                'UMI'=>'United States Minor Outlying Islands',
                'URY'=>'Uruguay',
                'USA'=>'United States',
                'UZB'=>'Uzbekistan',
                'VAT'=>'Holy See (Vatican City State)',
                'VCT'=>'Saint Vincent and the Grenadines',
                'VEN'=>'Venezuela, Bolivarian Republic of',
                'VGB'=>'Virgin Islands, British',
                'VIR'=>'Virgin Islands, U.S.',
                'VNM'=>'Viet Nam',
                'VUT'=>'Vanuatu',
                'WLF'=>'Wallis and Futuna',
                'WSM'=>'Samoa',
                'YEM'=>'Yemen',
                'ZAF'=>'South Africa',
                'ZMB'=>'Zambia',
                'ZWE'=>'Zimbabwe'
            );

            $crud = new JC_ProjetLP_crud();

            // Insert all default countries
            foreach ( $iso_array as $key => $value)
                $crud->add_country( $key, $value );

        }



    }

}