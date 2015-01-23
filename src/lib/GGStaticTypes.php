<?php 

namespace GoGlobalApi\lib;
/**
*	GoGlobal Static types and definitions
*/

class GGStaticTypes{

	
	/**
	*	RequestType
	*/
	public static RequestType = [
		'1'	=> 'HOTEL_SEARCH_REQUEST', 			// Availability Search
		'11'	=> 'HOTEL_SEARCH_REQUEST', 			// Availability Search /W Geo
		
		'6'	=> 'HOTEL_INFO_REQUEST', 			// Hotel Information
		'61'	=> 'HOTEL_INFO_REQUEST', 			// Hotel Information /W Geo
		
		'2'	=> 'BOOKING_INSERT_REQUEST', 			// Booking Insert
		'3'	=> 'BOOKING_CANCEL_REQUEST', 			// Booking Cancellation
		'4'	=> 'BOOKING_SEARCH_REQUEST', 			// Booking Search
		'10'	=> 'ADV_BOOKING_SEARCH_REQUEST', 		// Booking Search Adv 
		'5'	=> 'BOOKING_STATUS_REQUEST', 			// Booking Status
		'8'	=> 'VOUCHER_DETAILS_REQUEST', 			// Voucher Details
		'9'	=> 'BOOKING_VALUATION_REQUEST', 		// Booking Valuation
		'12'	=> 'PIGGIBANK_STATUS_REQUEST', 			// PiggyBank Details
		'13'	=> 'BOOKING_PAYMENT_REQUEST', 			// Booking Payment
		'14'	=> 'PRICE_BREAKDOWN_REQUEST', 			// Price Breakdown
		'15'	=> 'BOOKING_INFO_FOR_AMENDMENT_REQUEST', 	// Amendment Options
		'16'	=> 'BOOKING_AMENDMENT_REQUEST', 		// Amendment Request
		
		'17'	=> 'TRANSFER_SEARCH_REQUEST', 			// Transfer Search
		'19'	=> 'TB_INSERT_REQUEST' 				// Transfer Booking
	];	
	
	/**
	*	Room Codes
	*/
	public static RoomCodes = [
		'SGL' 		=> 'Single room',
		'DBL'		=> 'Double room',
		'TWN'		=> 'Twin room',
		'TPL'		=> 'Triple room',
		'QDR'		=> 'Quadruple room',
		'DBLSGL'	=> 'Double for Single Use'
	];
	
	/**
	* RoomBasis Codes
	*/	
	public static RoomBasisCodes = [
		'BB'	=> 'BED AND BREAKFAST',
		'CB'	=> 'CONTINENTAL BREAKFAST',
		'AI'	=> 'ALL-INCLUSIVE',
		'FB'	=> 'FULL-BOARD',
		'HB'	=> 'HALF-BOARD',
		'RO'	=> 'ROOM ONLY',
		'BD'	=> 'BED AND DINNER'	
	];
	
	/**
	* Star Codes
	*/	
	public static StarCodes = [
		'1'	=> '1 star',
		'2'	=> '1.5 stars',
		'3'	=> '2 stars',
		'4'	=> '2.5 stars',
		'5'	=> '3 stars',
		'6'	=> '3.5 stars',
		'7'	=> '4 stars',
		'8'	=> '4.5 star',
		'9'	=> '5 stars',
		'10'	=> '5.5 stars',
		'11'	=> '6 stars'
	];	
	
	/**
	* Sort Order Codes
	*/	
	public static SortOrderCodes = [
		'1'	=> 'By price', // first lowest prices
		'2'	=> 'By price', // first high prices
		'3'	=> 'By CXL Deadline', // first smallest dates
		'4'	=> 'By CXL Deadline', // first latest dates
	];	
	
	/**
	* Booking Statuses
	*/	
	public static BookingStatuses = [
		'RQ'	=> 'Requested',
		'C'	=> 'Confirmed',
		'RX'	=> 'Req. Cancellation',
		'X'	=> 'Cancelled',
		'RJ'	=> 'Rejected',
		'VCH'	=> 'Voucher Issued',
		'VRQ'	=> 'Voucher Req.'
	];

	
	/**
	*	Categories – for amendment request
	*/
	public static AmendmentCategories = [
		'STANDARD',
		'SUPERIOR',
		'DELUXE',
		'LUXURY',
		'PREMIUM',
		'JUNIOR SUITE',
		'SUITE',
		'MINI SUITE',
		'STUDIO',
		'EXECUTIVE'
	];
	
	/**
	* 	Error Codes
	*/	
	public static ErrorCodes = [
		'100'	=> 'General Errors',
		'101'	=> 'Error Parsing XML. Empty XML!',
		'102'	=> 'Error Parsing XML. Wrong Structure!',
		'103'	=> 'Cannot parse Operation!',
		'104'	=> 'Invalid Agency Header Details!',
		'105'	=> 'Could Not Retrieve Info - Try Again Later!',
		'200'	=> 'Hotel Search Errors',
		'201'	=> 'Cannot parse City Code!',
		'202'	=> 'Cannot parse Arrival Date!',
		'203'	=> 'Cannot parse Nights!',
		'204'	=> 'Cannot parse Total Number Of Rooms!',
		'205'	=> 'Cannot parse Type Of Room!',
		'206'	=> 'Cannot parse Number Of Rooms!',
		'207'	=> 'Wrong Room Type Specified!',
		'208'	=> 'Invalid Date Format!',
		'209'	=> 'The Specified City Code Does Not Exist!',
		'210'	=> 'Maximum Number Of Nights Is 99!',
		'211'	=> 'Too many Extra Beds or Cots',
		'212'	=> 'Children can only be in a Double or Twin Room',
		'213'	=> 'Cots can only be in a Double or Twin Room',
		'214'	=> 'We only allow search for 3 rooms in one search.',
		'215'	=> 'Wrong Child Age Specified.! The Child Age must be between 2 and 10.',
		'216'	=> 'Invalid destination',
		'300'	=> 'Booking Insert Errors',
		'301'	=> 'Cannot parse Agent Reference!',
		'302'	=> 'Cannot parse Hotel Search Code!',
		'303'	=> 'Cannot parse Arrival Date!',
		'304'	=> 'Cannot parse Nights!',
		'305'	=> 'Cannot parse NoAlternativeHotel!',
		'306'	=> 'Cannot parse LeaderPersonID!',
		'307'	=> 'Cannot parse RoomTypes!',
		'308'	=> 'Cannot parse Type Of Room!',
		'309'	=> 'Too many Extra Beds or Cots or "Too many Cots"',
		'310'	=> 'Wrong Room Type Specified!',
		'311'	=> 'Invalid Date Format!',
		'312'	=> 'The Specified Hotel Search Code Does Not Exist!',
		'313'	=> 'Maximum Number Of Nights Is 99!',
		'314'	=> 'Error In Sent XML. Wrong Structure!',
		'315'	=> 'Error Parsing Returned XML. Wrong Structure!',
		'400'	=> 'Booking Cancel Errors',
		'401'	=> 'Cannot parse GoBookingCode!',
		'402'	=> 'The Specified GoBookingCode Does Not Exist!',
		'500'	=> 'Booking Search Errors',
		'501'	=> 'Cannot parse GoBookingCode!',
		'502'	=> 'The Specified GoBookingCode Does Not Exist!',
		'600'	=> 'Booking Status Errors',
		'601'	=> 'Cannot parse Bookings!',
		'700'	=> 'Voucher request allowed only for booking on status confirm',
		'701'	=> 'this agency is not allowed to issue voucher -  Voucher Request was sent to Handling Office',
		'702'	=> 'credit limit is exceeded',
		'703'	=> 'Cannot cancel the booking at this time, please try later',
		'704'	=> 'This booking cannot be amended, please contact your Handling office for details'
	];	

	
	/**
	* 	Messages
	*/	
	public static Messages = [
		'1'	=> 'No Hotels Were Found Matching Searched Criteria!',
		'2'	=> 'The Cancellation Date is After The Cancellation Deadline. Please Contact Your Handling Office.',
		'3'	=> 'There Was No Booking(s) Found In The System Corresponding To The Given Booking Code(s)!',
		'4'	=> 'No bookings were found'
	];

	
}
