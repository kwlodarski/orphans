<?php

namespace Orphans;

class Orphans
{
  public static function replace($text)
  {
    if (empty($text)) {
      return;
    }
    $patterns = array(
      'al.', 'ale', 'ależ',
      'b.', 'bł.', 'bm.', 'bp', 'br.', 'by', 'bym', 'byś',
      'cyt.', 'cz.', 'czyt.',
      'dn.', 'do', 'doc.', 'dr', 'ds.', 'dyr.', 'dz.',
      'fot.',
      'gdy', 'gdyby', 'gdybym', 'gdybyś', 'gdyż', 'godz.',
      'im.', 'inż.',
      'jw.',
      'kol.', 'komu', 'ks.', 'która', 'którego', 'której', 'któremu', 'który', 'których', 'którym', 'którzy',
      'lic.',
      'max', 'mgr', 'm.in.', 'min', 'moich', 'moje', 'mojego', 'mojej', 'mojemu', 'mój', 'mych', 'na', 'nad', 'np.', 'nt.', 'nw.',
      'nr', 'nr.', 'nru', 'nrowi', 'nrem', 'nrze', 'nrze', 'nry', 'nrów', 'nrom', 'nrami', 'nrach',
      'od', 'oraz', 'os.',
      'p.', 'pl.', 'pn.', 'po', 'pod', 'pot.', 'prof.', 'przed', 'pt.', 'pw.', 'pw.',
      'śp.', 'św.',
      'tamtej', 'tamto', 'tej', 'tel.', 'tj.', 'to', 'twoich', 'twoje', 'twojego', 'twojej', 'twój', 'twych',
      'ul.',
      'we', 'wg', 'woj.',
      'za', 'ze',
      'że', 'żeby', 'żebyś',
    );

    /**
     * base therms replace
     */
    $re = '/^([aiouwz]|' . preg_replace('/\./', '\.', implode('|', $patterns)) . ') +/i';
    $text = preg_replace($re, "$1$2&nbsp;", $text);
    /**
     * replace space in numbers
     */
    $text = preg_replace('/(\d) (\d)/', "$1&nbsp;$2", $text);
    /**
     * single letters
     */
    $re = '/([ >\(]+)([aiouwz]|' . preg_replace('/\./', '\.', implode('|', $patterns)) . ') +/i';
    $text = preg_replace($re, "$1$2&nbsp;", $text);
    /**
     * single letter after previous orphan
     */
    $re = '/(&nbsp;)([aiouwz]) +/i';
    $text = preg_replace($re, "$1$2&nbsp;", $text);
    /**
     * polish year after number
     */
    $text = preg_replace('/(\d+) (r\.)/', "$1&nbsp;$2", $text);
    /**
     * return
     */
    return $text;
  }
}
