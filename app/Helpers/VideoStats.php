<?php

namespace App\Helpers;

class VideoStats {

	public function getBasicIndicators($metrics) {
		//dd($metrics);

		// foreach ($metrics as $element) {
		//     $info[$element['label']]['labels'][] = $element['date'];
		//     $info[$element['label']]['values'][] = $element['value'];
		// }
		foreach ($metrics as $element) {
			$info[$element['label']] = $element['value'];
		}

		return $info;
	}

	public function getRank($metrics, $subs) {

		$interactions = 0;

		foreach ($metrics as $label => $metric) {
			if ('viewCount' == $label) {
				$interactions += $metric;
			}
			if ('commentCount' == $label) {
				$interactions += $metric;
			}
			if ('likeCount' == $label) {
				$interactions += $metric;
			}
		}
		$rank = ($interactions) / ($subs * 100);

		return $rank;
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
