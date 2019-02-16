<?php
/**
 * SCallback for the Schema organization type field.
 *
 * @package    Mule_Plugin
 * @subpackage Admin\Partials\Field_Callbacks
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Mule_Plugin\Admin\Partials\Field_Callbacks;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$types = [

	// First option save null.
	null          => __( 'Select one&hellip;', 'mule-plugin' ),
	'Airline'     => __( 'Airline', 'mule-plugin' ),
	'Corporation' => __( 'Corporation', 'mule-plugin' ),

	// Educational Organizations.
	'EducationalOrganization' => __( 'Educational Organization', 'mule-plugin' ),
		'CollegeOrUniversity' => __( '— College or University', 'mule-plugin' ),
		'ElementarySchool'    => __( '— Elementary School', 'mule-plugin' ),
		'HighSchool'          => __( '— High School', 'mule-plugin' ),
		'MiddleSchool'        => __( '— Middle School', 'mule-plugin' ),
		'Preschool'           => __( '— Preschool', 'mule-plugin' ),
		'School'              => __( '— School', 'mule-plugin' ),

	'GovernmentOrganization'  => __( 'Government Organization', 'mule-plugin' ),

	// Local Businesses.
	'LocalBusiness' => __( 'Local Business', 'mule-plugin' ),
		'AnimalShelter' => __( '— Animal Shelter', 'mule-plugin' ),

		// Automotive Businesses.
		'AutomotiveBusiness' => __( '— Automotive Business', 'mule-plugin' ),
			'AutoBodyShop'     => __( '—— Auto Body Shop', 'mule-plugin' ),
			'AutoDealer'       => __( '—— Auto Dealer', 'mule-plugin' ),
			'AutoPartsStore'   => __( '—— Auto Parts Store', 'mule-plugin' ),
			'AutoRental'       => __( '—— Auto Rental', 'mule-plugin' ),
			'AutoRepair'       => __( '—— Auto Repair', 'mule-plugin' ),
			'AutoWash'         => __( '—— Auto Wash', 'mule-plugin' ),
			'GasStation'       => __( '—— Gas Station', 'mule-plugin' ),
			'MotorcycleDealer' => __( '—— Motorcycle Dealer', 'mule-plugin' ),
			'MotorcycleRepair' => __( '—— Motorcycle Repair', 'mule-plugin' ),

		'ChildCare'            => __( '— Child Care', 'mule-plugin' ),
		'Dentist'              => __( '— Dentist', 'mule-plugin' ),
		'DryCleaningOrLaundry' => __( '— Dry Cleaning or Laundry', 'mule-plugin' ),

		// Emergency Services.
		'EmergencyService' => __( '— Emergency Service', 'mule-plugin' ),
			'FireStation'   => __( '—— Fire Station', 'mule-plugin' ),
			'Hospital'      => __( '—— Hospital', 'mule-plugin' ),
			'PoliceStation' => __( '—— Police Station', 'mule-plugin' ),

		'EmploymentAgency' => __( '— Employment Agency', 'mule-plugin' ),

		// Entertainment Businesses.
		'EntertainmentBusiness' => __( '— Entertainment Business', 'mule-plugin' ),
			'AdultEntertainment' => __( '—— Adult Entertainment', 'mule-plugin' ),
			'AmusementPark'      => __( '—— Amusement Park', 'mule-plugin' ),
			'ArtGallery'         => __( '—— Art Gallery', 'mule-plugin' ),
			'Casino'             => __( '—— Casino', 'mule-plugin' ),
			'ComedyClub'         => __( '—— Comedy Club', 'mule-plugin' ),
			'MovieTheater'       => __( '—— Movie Theater', 'mule-plugin' ),
			'NightClub'          => __( '—— Night Club', 'mule-plugin' ),

		// Financial Services.
		'FinancialService' => __( '— Financial Service', 'mule-plugin' ),
			'AccountingService' => __( '—— Accounting Service', 'mule-plugin' ),
			'AutomatedTeller'   => __( '—— Automated Teller', 'mule-plugin' ),
			'BankOrCreditUnion' => __( '—— Bank or Credit Union', 'mule-plugin' ),
			'InsuranceAgency'   => __( '—— Insurance Agency', 'mule-plugin' ),

		// Food Establishments.
		'FoodEstablishment' => __( '— Food Establishment', 'mule-plugin' ),
			'Bakery'             => __( '—— Bakery', 'mule-plugin' ),
			'BarOrPub'           => __( '—— Bar or Pub', 'mule-plugin' ),
			'Brewery'            => __( '—— Brewery', 'mule-plugin' ),
			'CafeOrCoffeeShop'   => __( '—— Cafe or Coffee Shop', 'mule-plugin' ),
			'FastFoodRestaurant' => __( '—— Fast Food Restaurant', 'mule-plugin' ),
			'IceCreamShop'       => __( '—— Ice Cream Shop', 'mule-plugin' ),
			'Restaurant'         => __( '—— Restaurant', 'mule-plugin' ),
			'Winery'             => __( '—— Winery', 'mule-plugin' ),

		// Government Offices.
		'GovernmentOffice' => __( '— Government Office', 'mule-plugin' ),
			'PostOffice' => __( '—— Post Office', 'mule-plugin' ),

		// Health and Beauty Businesses.
		'HealthAndBeautyBusiness' => __( '— Health and Beauty Business', 'mule-plugin' ),
			'BeautySalon'  => __( '—— Beauty Salon', 'mule-plugin' ),
			'DaySpa'       => __( '—— Day Spa', 'mule-plugin' ),
			'HairSalon'    => __( '—— Hair Salon', 'mule-plugin' ),
			'HealthClub'   => __( '—— Health Club', 'mule-plugin' ),
			'NailSalon'    => __( '—— Nail Salon', 'mule-plugin' ),
			'TattooParlor' => __( '—— Tattoo Parlor', 'mule-plugin' ),

		// Home and Construction Businesses.
		'HomeAndConstructionBusiness' => __( '— Home and Construction Business', 'mule-plugin' ),
			'Electrician'       => __( '—— Electrician', 'mule-plugin' ),
			'GeneralContractor' => __( '—— General Contractor', 'mule-plugin' ),
			'HVACBusiness'      => __( '—— HVAC Business', 'mule-plugin' ),
			'HousePainter'      => __( '—— House Painter', 'mule-plugin' ),
			'Locksmith'         => __( '—— Locksmith', 'mule-plugin' ),
			'MovingCompany'     => __( '—— MovingCompany', 'mule-plugin' ),
			'Plumber'           => __( '—— Plumber', 'mule-plugin' ),
			'RoofingContractor' => __( '—— Roofing Contractor', 'mule-plugin' ),

		'InternetCafe' => __( '— Internet Cafe', 'mule-plugin' ),

		// Legal Services.
		'LegalService' => __( '— Legal Service', 'mule-plugin' ),
			'Attorney' => __( '—— Attorney', 'mule-plugin' ),
			'Notary'   => __( '—— Notary', 'mule-plugin' ),

		'Library' => __( '— Library', 'mule-plugin' ),

		// Lodging Businesses.
		'LodgingBusiness' => __( '— Lodging Business', 'mule-plugin' ),
			'BedAndBreakfast' => __( '—— Bed and Breakfast', 'mule-plugin' ),
			'Campground'      => __( '—— Campground', 'mule-plugin' ),
			'Hostel'          => __( '—— Hostel', 'mule-plugin' ),
			'Hotel'           => __( '—— Hotel', 'mule-plugin' ),
			'Motel'           => __( '—— Motel', 'mule-plugin' ),
			'Resort'          => __( '—— Resort', 'mule-plugin' ),

		'ProfessionalService' => __( '— Professional Service', 'mule-plugin' ),
		'RadioStation'        => __( '— Radio Station', 'mule-plugin' ),
		'RealEstateAgent'     => __( '— Real Estate Agent', 'mule-plugin' ),
		'RecyclingCenter'     => __( '— Recycling Center', 'mule-plugin' ),
		'SelfStorage'         => __( '— Self Storage', 'mule-plugin' ),
		'ShoppingCenter'      => __( '— Shopping Center', 'mule-plugin' ),

		// Sports Activity Locations.
		'SportsActivityLocation' => __( '— Sports Activity Location', 'mule-plugin' ),
			'BowlingAlley'       => __( '—— Bowling Alley', 'mule-plugin' ),
			'ExerciseGym'        => __( '—— Exercise Gym', 'mule-plugin' ),
			'GolfCourse'         => __( '—— Golf Course', 'mule-plugin' ),
			'HealthClub'         => __( '—— Health Club', 'mule-plugin' ),
			'PublicSwimmingPool' => __( '—— Public Swimming Pool', 'mule-plugin' ),
			'SkiResort'          => __( '—— Ski Resort', 'mule-plugin' ),
			'SportsClub'         => __( '—— Sports Club', 'mule-plugin' ),
			'StadiumOrArena'     => __( '—— Stadium or Arena', 'mule-plugin' ),
			'TennisComplex'      => __( '—— Tennis Complex', 'mule-plugin' ),

		// Store types.
		'Store' => __( '— Store', 'mule-plugin' ),
			'AutoPartsStore'      => __( '—— Auto Parts Store', 'mule-plugin' ),
			'BikeStore'           => __( '—— Bike Store', 'mule-plugin' ),
			'BookStore'           => __( '—— Book Store', 'mule-plugin' ),
			'ClothingStore'       => __( '—— Clothing Store', 'mule-plugin' ),
			'ComputerStore'       => __( '—— Computer Store', 'mule-plugin' ),
			'ConvenienceStore'    => __( '—— Convenience Store', 'mule-plugin' ),
			'DepartmentStore'     => __( '—— Department Store', 'mule-plugin' ),
			'ElectronicsStore'    => __( '—— Electronics Store', 'mule-plugin' ),
			'Florist'             => __( '—— Florist', 'mule-plugin' ),
			'FurnitureStore'      => __( '—— Furniture Store', 'mule-plugin' ),
			'GardenStore'         => __( '—— Garden Store', 'mule-plugin' ),
			'GroceryStore'        => __( '—— Grocery Store', 'mule-plugin' ),
			'HardwareStore'       => __( '—— Hardware Store', 'mule-plugin' ),
			'HobbyShop'           => __( '—— Hobby Shop', 'mule-plugin' ),
			'HomeGoodsStore'      => __( '—— Home Goods Store', 'mule-plugin' ),
			'JewelryStore'        => __( '—— Jewelry Store', 'mule-plugin' ),
			'LiquorStore'         => __( '—— Liquor Store', 'mule-plugin' ),
			'MensClothingStore'   => __( '—— Mens Clothing Store', 'mule-plugin' ),
			'MobilePhoneStore'    => __( '—— Mobile Phone Store', 'mule-plugin' ),
			'MovieRentalStore'    => __( '—— Movie Rental Store', 'mule-plugin' ),
			'MusicStore'          => __( '—— Music Store', 'mule-plugin' ),
			'OfficeEquipmentStore'=> __( '—— Office Equipment Store', 'mule-plugin' ),
			'OutletStore'         => __( '—— Outlet Store', 'mule-plugin' ),
			'PawnShop'            => __( '—— Pawn Shop', 'mule-plugin' ),
			'PetStore'            => __( '—— Pet Store', 'mule-plugin' ),
			'ShoeStore'           => __( '—— Shoe Store', 'mule-plugin' ),
			'SportingGoodsStore'  => __( '—— Sporting Goods Store', 'mule-plugin' ),
			'TireShop'            => __( '—— Tire Shop', 'mule-plugin' ),
			'ToyStore'            => __( '—— Toy Store', 'mule-plugin' ),
			'WholesaleStore'      => __( '—— Wholesale Store', 'mule-plugin' ),

		'TelevisionStation'        => __( '— Television Station', 'mule-plugin' ),
		'TouristInformationCenter' => __( '— Tourist Information Center', 'mule-plugin' ),
		'TravelAgency'             => __( '— Travel Agency', 'mule-plugin' ),

	'MedicalOrganization' => __( 'Medical Organization', 'mule-plugin' ),
	'NGO'                 => __( 'NGO (Non-Governmental Organization', 'mule-plugin' ),
	'PerformingGroup'     => __( 'Performing Group', 'mule-plugin' ),
	'SportsOrganization'  => __( 'Sports Organization', 'mule-plugin' )
];

$options = get_option( 'schema_org_type' );

$html = '<p><select id="schema_org_type" name="schema_org_type">';

foreach( $types as $type => $value ) {

	$selected = ( $options == $type ) ? 'selected="' . esc_attr( 'selected' ) . '"' : '';

	$html .= '<option value="' . esc_attr( $type ) . '" ' . $selected . '>' . esc_html( $value ) . '</option>';

}

$html .= '</select>';
$html .= sprintf(
	'<label for="schema_org_type"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
	$args[0],
	esc_attr( esc_url( 'https://schema.org/docs/full.html#C.Organization' ) ),
	esc_attr( __( 'Read documentation for organization types', 'mule-plugin' ) )
);
$html .= '</p>';

echo $html;