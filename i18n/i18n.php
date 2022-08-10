<?php

include 'trans.php';

/**
 * I18N for D'artagnan
 * @property array $trans the list of translations for the selected language
 */
class I18N {
  /**
   * Selects language for I18N
   * @param string $lang
   * @return string
   */
  function __construct($lang = '')
  {
    global $TRANS;
    if(isset($_COOKIE['lang']) && $lang == '') {
      $lang = $_COOKIE['lang'];
    }
    if(array_key_exists($lang, $TRANS)) {
      $this->trans = $TRANS[$lang];
    } else {
      $this->trans = $TRANS['en'];
    }
  }

  /**
   * @param string $key searched key from translation
   * @return string
   * @throws KeyNotFoundError if key does not exists in the translation
   */
  function get($key) {
    $key = strtolower($key);
    if(!array_key_exists($key, $this->trans))
      throw new KeyNotFoundError();
    return $this->trans[$key];
  }
}

class KeyNotFoundError extends Exception {}