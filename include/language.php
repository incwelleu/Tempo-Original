<?php

// If language is not yet set, check the default language or try to get the language from your browser.
// All possible languages available, used for selecting the right language file.
/* $languages = array(
    'af' => 'african',
    'sq' => 'albanian',
    'ar' => 'arabic',
    'ar-dz' => 'arabic', // algeria
    'ar-bh' => 'arabic', // bahrain
    'ar-eg' => 'arabic', // egypt
    'ar-iq' => 'arabic', // iraq
    'ar-jo' => 'arabic', // jordan
    'ar-kw' => 'arabic', // kuwait
    'ar-lb' => 'arabic', // lebanon
    'ar-ly' => 'arabic', // libya
    'ar-ma' => 'arabic', // morocco
    'ar-om' => 'arabic', // oman
    'ar-qa' => 'arabic', // qatar
    'ar-sa' => 'arabic', // Saudi Arabia
    'ar-sy' => 'arabic', // syria
    'ar-tn' => 'arabic', // tunisia
    'ar-ae' => 'arabic', // U.A.E
    'ar-ye' => 'arabic', // yemen
    'hy' => 'armenian',
    'ast' => 'asturian',
    'eu' => 'basque',
    'be' => 'belarusian',
    'bs' => 'bosnian',
    'bg' => 'bulgarian',
    'ca' => 'catalan',
    'zh' => 'chinese',
    'zh-smp' => 'chinese simplified', // China Simplified
    'zh-cn' => 'chinese', // China
    'zh-hk' => 'chinese', // Hong Kong
    'zh-sg' => 'chinese', // Singapore
    'zh-tw' => 'chinese', // Taiwan
    'hr' => 'croatian',
    'cs' => 'czech',
    'da' => 'danish',
    'nl' => 'dutch',
    'nl-be' => 'dutch', // Belgium
    'en' => 'english',
    'en-au' => 'english', // Australia
    'en-bz' => 'english', // Belize
    'en-ca' => 'english', // Canada
    'en-ie' => 'english', // Ireland
    'en-jm' => 'english', // Jamaica
    'en-nz' => 'english', // New Zealand
    'en-ph' => 'english', // Philippines
    'en-za' => 'english', // South Africa
    'en-tt' => 'english', // Trinidad
    'en-gb' => 'english', // United Kingdom
    'en-us' => 'english', // United States
    'en-zw' => 'english', // Zimbabwe
    'eo' => 'esperanto',
    'et' => 'estonian',
    'fo' => 'faeroese',
    'fi' => 'finnish',
    'fr' => 'french',
    'fr-be' => 'french', // Belgium
    'fr-ca' => 'french', // Canada
    'fr-fr' => 'french', // France
    'fr-lu' => 'french', // Luxembourg
    'fr-mc' => 'french', // Monaco
    'fr-ch' => 'french', // Switzerland
    'gl' => 'galician',
    'ka' => 'georgian',
    'de' => 'german',
    'de-at' => 'german', // Austria
    'de-de' => 'german', // Germany
    'de-li' => 'german', // Liechtenstein
    'de-lu' => 'german', // Luxembourg
    'de-ch' => 'german', // Switzerland
    'el' => 'greek',
    'he' => 'hebrew',
    'hu' => 'hungarian',
    'is' => 'icelandic',
    'id' => 'indonesian',
    'ga' => 'irish',
    'it' => 'italian',
    'it-ch' => 'italian', // Switzerland
    'ja' => 'japanese',
    'ko' => 'korean',
    'ko-kp' => 'korean', // North Korea
    'ko-kr' => 'korean', // South Korea
    'lv' => 'latvian',
    'lt' => 'lithuanian',
    'mk' => 'macedonian',
    'ms' => 'malay',
    'no' => 'norwegian',
    'nb' => 'norwegian bokmal',
    'nn' => 'norwegian nynorsk',
    'pl' => 'polish',
    'pt' => 'portuguese',
    'pt-br' => 'portuguese', // Brazil
    'ro' => 'romanian',
    'ru' => 'russian',
    'gd' => 'scots gealic',
    'sr' => 'serbian',
    'sk' => 'slovak',
    'sl' => 'slovenian',
    'es' => 'spanish',
    'sv' => 'swedish',
    'sv-fi' => 'swedish', // Finland
    'th' => 'thai',
    'tr' => 'turkish',
    'uk' => 'ukrainian',
    'vi' => 'vietnamese',
    'cy' => 'welsh',
    'xh' => 'xhosa',
    'yi' => 'yiddish',
    'zu' => 'zulu'
);
*/

$languages = array(
    'en' => 'English',
    'es' => 'Spanish',
	'fr' => 'French'
);

$language = isset($_SESSION['language']) ? $_SESSION['language'] : "";

if($language==""){
  $browser_lang = strtolower(getenv("HTTP_ACCEPT_LANGUAGE"));
  $browser_lang = explode( ';', $browser_lang );
  $browser_lang = explode( ',', $browser_lang[0] );

  foreach ($browser_lang as $value){
    if (($tmplang = strtolower($languages[$value])) && (file_exists("include/language/" . $tmplang . ".lang.php"))) {
      $language = $value;
      break;
    }
  }

  if (!$language) $language = "en";
}

$languageftp = strtolower($languages[$language]);

//Include Language file
require_once("language/" . $languageftp . ".lang.php");   // Selected language

Global $application, $XLMLanguage;

$application->Language = $XLMLanguage;


?>