<?php namespace app\Helpers;

/**
 * Akkar Global Services - Language Functions Helper
 *
 * @author  Julio Hernandez <juliohernandezs@gmail.com>
 */

class Language {
    /**
     * setLanguage Menu
     * @return [void]
     *
     * @author  Julio Hernandez <juliohernandezs@gmail.com>
     */
    public static function setLanguage($language = null) {
  		
        \App::setLocale( ($language) ? $language : ( (\Auth::user()) ? \Auth::user()->language : 'en' ) );
    }

}
