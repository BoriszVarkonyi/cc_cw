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
   * @param Options $options (optional)
   * @return string
   * @throws KeyNotFoundError if key does not exists in the translation
   */
  function get($key, $options = null) {
    $key = strtolower($key);
    if(!array_key_exists($key, $this->trans))
      throw new KeyNotFoundError();
    if($options != null) {
      switch ($options) {
        case Options::UPPERCASE:
          return mb_strtoupper($this->trans[$key]);
        case Options::CAPFIRST:
          return ucfirst($this->trans[$key]);
        case Options::CAPALL:
          return ucwords($this->trans[$key]);
        default:
          return $this->trans[$key];
      }
    }
    return $this->trans[$key];
  }
}

enum Options {
  case UPPERCASE;
  case CAPFIRST;
  case CAPALL;
}

class KeyNotFoundError extends Exception {}