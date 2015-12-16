<?php
class JSONConverterTool {
	public function event2JSON($event, $isSiteAdmin=false) {
		$event['Event']['Attribute'] = $event['Attribute'];
		$event['Event']['ShadowAttribute'] = $event['ShadowAttribute'];
		$event['Event']['RelatedEvent'] = $event['RelatedEvent'];
		if (isset($event['RelatedAttribute'])) $event['Event']['RelatedAttribute'] = $event['RelatedAttribute'];
		else $event['Event']['RelatedAttribute'] = array();
		//
		// cleanup the array from things we do not want to expose
		//
		unset($event['Event']['user_id']);
		// hide the org field is we are not in showorg mode
		if (!Configure::read('MISP.showorg') && !$isSiteAdmin) {
			unset($event['Event']['org']);
			unset($event['Event']['orgc']);
			unset($event['Event']['from']);
		}
		
		if (isset($event['Event']['Attribute'])) {
			// remove value1 and value2 from the output and remove invalid utf8 characters for the xml parser
			foreach ($event['Event']['Attribute'] as $key => $value) {
				unset($event['Event']['Attribute'][$key]['value1']);
				unset($event['Event']['Attribute'][$key]['value2']);
				unset($event['Event']['Attribute'][$key]['category_order']);
				if (isset($event['Event']['RelatedAttribute'][$value['id']])) $event['Event']['Attribute'][$key]['RelatedAttribute'] = $event['Event']['RelatedAttribute'][$value['id']];
			}
		}
		unset($event['Event']['RelatedAttribute']);
		
		if (isset($event['Event']['RelatedEvent'])) {
			foreach ($event['Event']['RelatedEvent'] as $key => $value) {
				$temp = $value['Event'];
				unset($event['Event']['RelatedEvent'][$key]['Event']);
				$event['Event']['RelatedEvent'][$key]['Event'][0] = $temp;
				unset($event['Event']['RelatedEvent'][$key]['Event'][0]['user_id']);
				if (!Configure::read('MISP.showorg') && !$isSiteAdmin) {
					unset($event['Event']['RelatedEvent'][$key]['Event'][0]['org']);
					unset($event['Event']['RelatedEvent'][$key]['Event'][0]['orgc']);
				}
				unset($temp);
			}
		}
		$result = array('Event' => $event['Event']);
		if (isset($event['errors']))$result = array_merge($result, array('errors' => $event['errors']));
		return json_encode($result);
	}
	
	public function arrayPrinter($array, $root = true) {
		if (is_array($array)) {
			$resultArray = array();
			foreach ($array as $k => $element) {
				$temp = $this->arrayPrinter($element, false);
				if (!is_array($temp)) {
					$resultArray[] = '[' . $k .']' . $temp;	
				} else {
					foreach ($temp as &$t) $resultArray[] = '[' . $k . ']' . $t;
				}
			}
		} else $resultArray = ': ' . $array . PHP_EOL;
		if ($root) {
			$text = '';
			foreach ($resultArray as &$r) $text .= $r;
			return $text;
		} else return $resultArray;
	}
}