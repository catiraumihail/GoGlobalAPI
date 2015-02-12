<?php

/* GoGlobal response parser */

namespace GoGlobalApi\lib;

class GGResponseParser{
	
	public static function parseHotelsList ($xmlString) {
    		//print "<textarea rows=40 cols=60>".format_xml($xmlString)."</textarea>"; exit;
		$response = [];
		$xml = \SimpleXMLElement($xmlString);
		if ($xml->Header->Statistics->ResultsQty > 0) {
			foreach($xml->Main->children() as $hotel) {
				$u = explode("/", (string) $hotel->HotelSearchCode);
				$u = $u[0];
				$response = [
					"HotelSearchCode" 	=> (string) $hotel->HotelSearchCode,
					"HotelUnique" 		=> $u,
					"HotelCode" 		=> (string) $hotel->HotelCode,
					"HotelName" 		=> (string) $hotel->HotelName,
					"CountryId" 		=> (string) $hotel->CountryId,
					"CxlDeadline" 		=> (string) $hotel->CxlDeadline,
					"RoomType" 		=> (string) $hotel->RoomType,
					"RoomBasis" 		=> (string) $hotel->RoomBasis,
					"Availability" 		=> (string) $hotel->Availability,
					"TotalPrice" 		=> (string) $hotel->TotalPrice,
					"Currency" 		=> (string) $hotel->Currency,
					"Category" 		=> (string) $hotel->Category,
					"Location" 		=> (string) $hotel->Location,
					"LocationCode" 		=> (string) $hotel->LocationCode,
					"Preferred" 		=> (string) $hotel->Preferred,
					"Remark" 		=> (string) $hotel->Remark,
					"SpecialOffer" 		=> (string) $hotel->SpecialOffer,
					"Thumbnail" 		=> (string) $hotel->Thumbnail
				];				
				if(count($hotel->GeoCodes->children()) == 2) {
					$response['Latitude'] 	= (string) $hotel->GeoCodes->Latitude;
					$response['Longitude'] 	= (string) $hotel->GeoCodes->Longitude;
				}
				if(count($hotel->TripAdvisor->children()) == 4) {
					$response['Rating'] 		= (string) $hotel->TripAdvisor->Rating;
					$response['RatingImage'] 	= (string) $hotel->TripAdvisor->RatingImage;
					$response['Reviews']		= (string) $hotel->TripAdvisor->Reviews;
					$response['ReviewCount'] 	= (string) $hotel->TripAdvisor->ReviewCount;
				}
			}
		}
		return $response;
	}
	
	public static function parseHotelInfo ($xmlString) {
    		//print "<textarea rows=40 cols=60>".format_xml($xmlString)."</textarea>"; exit;
		$xml = new \SimpleXMLElement($xmlString);
		$hotel = $xml->Main;
	    	$response = [
	            'HotelCode' 		=> (string) $hotel->HotelSearchCode,
	            'HotelName' 		=> (string) $hotel->HotelName,
	            'Address' 			=> (string) $hotel->Address,
	            'CityCode' 			=> (string) $hotel->CityCode,
	            'Phone' 			=> (string) $hotel->Phone,
	            'Fax' 			=> (string) $hotel->Fax,
	            'Category'			=> (string) $hotel->Category,
	            'Description' 		=> (string) $hotel->Description,
	            'HotelFacilities'		=> (string) $hotel->HotelFacilities,
	            'RoomFacilities' 		=> (string) $hotel->RoomFacilities,
	            'RoomCount' 		=> (string) $hotel->RoomCount,
	            'Pictures' 			=> [],
	        ];
	        $pics = $hotel->Pictures->children()->Picture;
	        if(count($pics) > 0) {
	            foreach($pics as $picture) {
	                $response['Pictures'][] = (string)$picture;
	            }
	        }
	        if(count($hotel->GeoCodes->children()) == 2) {
	            $response['Latitude'] 	= (string) $hotel->GeoCodes->Latitude;
	            $response['Longitude'] 	= (string) $hotel->GeoCodes->Longitude;
	        }
	        if(count($hotel->TripAdvisor->children()) == 4) {
	            $response['Rating'] 	= (string) $hotel->TripAdvisor->Rating;
	            $response['RatingImage'] 	= (string) $hotel->TripAdvisor->RatingImage;
	            $response['Reviews']	= (string) $hotel->TripAdvisor->Reviews;
	            $response['ReviewCount'] 	= (string) $hotel->TripAdvisor->ReviewCount;
	        }
	        return $response;
	}
	
	public static function parseBookingInsert ($xmlString) {
    		//print "<textarea rows=40 cols=60>".format_xml($xmlString)."</textarea>"; exit;
    		$xml = new SimpleXMLElement($xmlString);
		$booking = $xml->Main;
    		$response = [
			'GoBookingCode' 		=> (string) $booking->GoBookingCode,
			'GoReference' 			=> (string) $booking->GoReference,
			'ClientBookingCode' 		=> (string) $booking->ClientBookingCode,
			'BookingStatus' 		=> (string) $booking->BookingStatus,
			'TotalPrice' 			=> (string) $booking->TotalPrice,
			'Currency' 			=> (string) $booking->Currency,
			'HotelName'			=> (string) $booking->HotelName,
			'HotelSearchCode' 		=> (string) $booking->HotelSearchCode,
			'CityCode' 			=> (string) $booking->CityCode
			'RoomType' 			=> (string) $booking->RoomType,
			'RoomBasis' 			=> (string) $booking->RoomBasis,
			'ArrivalDate' 			=> (string) $booking->ArrivalDate,
			'CancellationDeadline' 		=> (string) $booking->CancellationDeadline,
			'Nights' 			=> (string) $booking->Nights,
			'NoAlternativeHotel' 		=> (string) $booking->NoAlternativeHotel,
			'LeaderPersonID' 		=> (string) $booking->Leader->attributes()->LeaderPersonID,
			'Remark' 			=> (string) $booking->Remark,
			'Preferances'			=> [],
			'Rooms'				=> []		
		];
		foreach($booking->Preferances as $preferance) {
			$key => (string) $preferance->getName();
			$value => (string) $preferance;
			$booking->Preferances[$key] = $value;
		}
		foreach($booking->Rooms as $roomType) {
			$roomTypeData = [
				"Type" 		=> (string) $roomType->attributes()->Type,
				"Adults" 	=> (string) $roomType->attributes()->Adults,
				"Cots" 		=> (string) $roomType->attributes()->Cots,
				"Rooms"		=> []
			];
			foreach($roomType as $room) {
				$roomData = [
					'RoomID' 	=> $room->attributes()->RoomID,
					'Category' 	=> $room->attributes()->Category,
					'Persons'	=> []
				]; 
				foreach($room as $person){
					if($person->getName() == "PersonName"){
						$person = [
							'PersonID' 		=> $person->attributes()->PersonID,
							'Type' 			=> 'ADT',
							'PersonName' 		=> (string) $person							
						];
					} else {
						$person = [
							'PersonID' 		=> $person->attributes()->PersonID,
							'Type' 			=> 'CHD',
							'Age'			=> $person->attributes()->ChildAge,
							'PersonName' 		=> (string) $person							
						];	
					}
					$roomData['Persons'][] = $person;
				}
				$roomTypeData['Rooms'][] = $roomData;
			}
			$response['Rooms'][] = $roomTypeData;
		}
    		return $response;
	}
	
	public static function parseBookingCancel ($xmlString) {
    		//print "<textarea rows=40 cols=60>".format_xml($xmlString)."</textarea>"; exit;
    		$xml = new SimpleXMLElement($xmlString);
		$booking = $xml->Main;
    		$response = [
			'GoBookingCode' => $booking->GoBookingCode,
			'BookingStatus' => $booking->BookingStatus,
		];
        	return $response;
	}
	
	public static function parseBookingSearch ($xmlString) {
    		//print "<textarea rows=40 cols=60>".format_xml($xmlString)."</textarea>"; exit;
    		$xml = new SimpleXMLElement($xmlString);
		$booking = $xml->Main;
    		$response = [
			'GoBookingCode' 		=> (string) $booking->GoBookingCode,
			'GoReference' 			=> (string) $booking->GoReference,
			'ClientBookingCode' 		=> (string) $booking->ClientBookingCode,
			'BookingStatus' 		=> (string) $booking->BookingStatus,
			'TotalPrice' 			=> (string) $booking->TotalPrice,
			'Currency' 			=> (string) $booking->Currency,
			'HotelName'			=> (string) $booking->HotelName,
			'HotelSearchCode' 		=> (string) $booking->HotelSearchCode,
			'CityCode' 			=> (string) $booking->CityCode
			'RoomType' 			=> (string) $booking->RoomType,
			'RoomBasis' 			=> (string) $booking->RoomBasis,
			'ArrivalDate' 			=> (string) $booking->ArrivalDate,
			'CancellationDeadline' 		=> (string) $booking->CancellationDeadline,
			'Nights' 			=> (string) $booking->Nights,
			'NoAlternativeHotel' 		=> (string) $booking->NoAlternativeHotel,
			'LeaderPersonID' 		=> (string) $booking->Leader->attributes()->LeaderPersonID,
			'Remark' 			=> (string) $booking->Remark,
			'Preferances'			=> [],
			'Rooms'				=> []		
		];
		foreach($booking->Preferances as $preferance) {
			$key => (string) $preferance->getName();
			$value => (string) $preferance;
			$booking->Preferances[$key] = $value;
		}
		foreach($booking->Rooms as $roomType) {
			$roomTypeData = [
				"Type" 		=> (string) $roomType->attributes()->Type,
				"Adults" 	=> (string) $roomType->attributes()->Adults,
				"Cots" 		=> (string) $roomType->attributes()->Cots,
				"Rooms"		=> []
			];
			foreach($roomType as $room) {
				$roomData = [
					'RoomID' 	=> $room->attributes()->RoomID,
					'Category' 	=> $room->attributes()->Category,
					'Persons'	=> []
				]; 
				foreach($room as $person){
					if($person->getName() == "PersonName"){
						$person = [
							'PersonID' 		=> $person->attributes()->PersonID,
							'Type' 			=> 'ADT',
							'PersonName' 	=> (string) $person							
						];
					} else {
						$person = [
							'PersonID' 		=> $person->attributes()->PersonID,
							'Type' 			=> 'CHD',
							'Age'			=> $person->attributes()->ChildAge,
							'PersonName' 	=> (string) $person							
						];	
					}
					$roomData['Persons'][] = $person;
				}
				$roomTypeData['Rooms'][] = $roomData;
			}
			$response['Rooms'][] = $roomTypeData;
		}
        	return $response;
	}
	
	public static function parseBookingSearchAdv ($xmlString) {
    		//print "<textarea rows=40 cols=60>".format_xml($xmlString)."</textarea>"; exit;
    		$xml = new \SimpleXMLElement($xmlString);
		$responses = [];
		foreach($xml->Main->Bookings->Booking $as $booking){
			$response = [
				'GoBookingCode' 		=> (string) $booking->GoBookingCode,
				'GoReference' 			=> (string) $booking->GoReference,
				'ClientBookingCode' 		=> (string) $booking->ClientBookingCode,
				'BookingStatus' 		=> (string) $booking->BookingStatus,
				'TotalPrice' 			=> (string) $booking->TotalPrice,
				'Currency' 			=> (string) $booking->Currency,
				'HotelName'			=> (string) $booking->HotelName,
				'HotelSearchCode' 		=> (string) $booking->HotelSearchCode,
				'CityCode' 			=> (string) $booking->CityCode
				'RoomType' 			=> (string) $booking->RoomType,
				'RoomBasis' 			=> (string) $booking->RoomBasis,
				'ArrivalDate' 			=> (string) $booking->ArrivalDate,
				'CancellationDeadline' 		=> (string) $booking->CancellationDeadline,
				'Nights' 			=> (string) $booking->Nights,
				'NoAlternativeHotel' 		=> (string) $booking->NoAlternativeHotel,
				'LeaderPersonID' 		=> (string) $booking->Leader->attributes()->LeaderPersonID,
				'Remark' 			=> (string) $booking->Remark,
				'Preferances'			=> [],
				'Rooms'					=> []		
			];
			foreach($booking->Preferances as $preferance) {
				$key => (string) $preferance->getName();
				$value => (string) $preferance;
				$booking->Preferances[$key] = $value;
			}
			foreach($booking->Rooms as $roomType) {
				$roomTypeData = [
					"Type" 		=> (string) $roomType->attributes()->Type,
					"Adults" 	=> (string) $roomType->attributes()->Adults,
					"Cots" 		=> (string) $roomType->attributes()->Cots,
					"Rooms"		=> []
				];
				foreach($roomType as $room) {
					$roomData = [
						'RoomID' 	=> $room->attributes()->RoomID,
						'Category' 	=> $room->attributes()->Category,
						'Persons'	=> []
					]; 
					foreach($room as $person){
						if($person->getName() == "PersonName"){
							$person = [
								'PersonID' 		=> $person->attributes()->PersonID,
								'Type' 			=> 'ADT',
								'PersonName' 		=> (string) $person							
							];
						} else {
							$person = [
								'PersonID' 		=> $person->attributes()->PersonID,
								'Type' 			=> 'CHD',
								'Age'			=> $person->attributes()->ChildAge,
								'PersonName' 		=> (string) $person							
							];	
						}
						$roomData['Persons'][] = $person;
					}
					$roomTypeData['Rooms'][] = $roomData;
				}
				$response['Rooms'][] = $roomTypeData;
			}
			$responses[] = $response;
		}        
        	return $responses;
	}
	
	public static function parseBookingCheckStatus ($xmlString) {
    		//print "<textarea rows=40 cols=60>".format_xml($xmlString)."</textarea>"; exit;
    		$xml = new SimpleXMLElement($xmlString);
		$responses = [];
		foreach($xml->Main->GoBookingCode $as $booking){
			$id = (string) $booking;
			$response = [				
				'GoBookingCode' => $id,
				'GoReference' 	=> (string) $booking->attributes()->GoReference,
				'Status' 	=> (string) $booking->attributes()->Status,	
				'TotalPrice' 	=> (string) $booking->attributes()->TotalPrice,	
				'Currency' 	=> (string) $booking->attributes()->TotalPrice,	
			];
			$responses[$id] = $response;
		}        
    		return $responses;
	}

}
