<?php

namespace App\Helpers;

class PlaylistStats {

	public function getBasicIndicators($metrics) {
		//dd($metrics);

		foreach ($metrics as $key => $metric) {

			$info[$key] = $metric;
		}

		return $info;
	}

	public function getBasicInfo($data) {
		/*dd($data);*/

		foreach ($data as $key => $element) {

			$info[$key] = $element;
		}
		//dd($info);

		return $info;
	}

// function getEngagement($metrics)
	//     {
	//         //dd($metrics);
	//         $interactions    = 0;
	//         $subscriberCount = 0;
	//         $videoCount      = 0;

//     foreach ($metrics as $element) {
	//             //dd($element['label']);
	//             if ('subscriberCount' == $element['label']) {
	//                 $subscriberCount += $element['value'];
	//                 dd($subscriberCount);

//             //$time[] = $element['date'];
	//                 // continue;
	//             }
	//             if ('likeCount' == $element['label'] || 'commentCount' == $element['label']) {
	//                 $interactions += $element['value'];
	//                 $time[]       = $element['date'];
	//                 $engagement[] = $interactions / ($subscriberCount * 100);
	//             }

//         if ('videoCount' == $element['label']) {
	//                 $videoCount += $element['value'];
	//                 // continue;
	//             }

//         // $sumInteractions += $element['value'];
	//         }
	//         dd($engagement);
	//         // $avgEngagement = $engagement / $videoCount;
	//         //dd($engagement);

//     $chart = Chart::initChart(str_random(5), 'line', 'Engagement')->setLabels($time)->addDataSets($subscriberCount);

//     //dd($chart);

//     return $chart;
	//     }

//     public function getEngagement($metrics)
	//     {
	//         //dd($metrics);
	//         $interactions    = 0;
	//         $subscriberCount = 0;
	//         $videoCount      = 0;

//         foreach ($metrics as $element) {
	//             //dd($element['label']);
	//             if ('subscriberCount' == $element['label']) {
	//                 $subscriberCount += $element['value'];
	//                 //dd($subscriberCount);

//                 //$time[] = $element['date'];
	//                 // continue;
	//             }
	//             if ('commentCount' == $element['label']) {
	//                 $interactions += $element['value'];
	//                 $time[]       = $element['date'];
	//                 $engagement[] = $interactions / ($subscriberCount * 100);
	//             }

//             if ('videoCount' == $element['label']) {
	//                 $videoCount += $element['value'];
	//                 // continue;
	//             }

//             // $sumInteractions += $element['value'];
	//         }
	//         //dd($engagement);
	//         // $avgEngagement = $engagement / $videoCount;
	//         //dd($engagement);

//         $chart = Chart::initChart(str_random(5), 'line', 'Engagement')->setLabels($time)->addDataSets($subscriberCount);

//         //dd($chart);

//         return $chart;
	//     }

// //Le nombre d’interactions sur les publications (Like+commentaire+partage) sur le nombre de fans X 100.

// //Le taux d’engagement/nombre de publication.

// //FANS : PROGRESSION

//     public function getFansProgression($metrics)
	//     {
	//         //
	//         //dd($metrics);
	//         foreach ($metrics as $key => $element) {
	//             //dd($element['values']);
	//             if ('subscriberCount' == $key) {
	//                 $subscriberCount[] = $element['values'];
	//                 $time[]            = $element['labels'];
	//                 continue;
	//             }
	//             //$time[] = $element['labels'];
	//         }

//         $chart = self::getLineChart($subscriberCount, $time);
	//         //dd($chart);

//         return $chart;
	//     }
}
