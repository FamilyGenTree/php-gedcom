<?php

namespace Gedcom;

require_once __DIR__ . '/Record/Individual.php';
require_once __DIR__ . '/Record/Family.php';
require_once __DIR__ . '/Record/Source.php';
require_once __DIR__ . '/Record/Note.php';
require_once __DIR__ . '/Record/Note/Reference.php';
require_once __DIR__ . '/Record/ReferenceNumber.php';
require_once __DIR__ . '/Record/SourceRepositoryCitation.php';
require_once __DIR__ . '/Record/SourceCallNumber.php';
require_once __DIR__ . '/Record/Data.php';
require_once __DIR__ . '/Record/Change.php';
require_once __DIR__ . '/Record/Object.php';
require_once __DIR__ . '/Record/Note/Text.php';
require_once __DIR__ . '/Parser.php';

use Gedcom\Record\Individual;
use Gedcom\Record\Family;
use Gedcom\Record\Source;
use Gedcom\Record\Note;
use Gedcom\Record\SourceRepositoryCitation;
use Gedcom\Record\SourceCallNumber;
use Gedcom\Record\Data;
use Gedcom\Record\Note\Text;

/**
 *
 *
 */
class Gedcom
{
    public $head = null;
    public $submission = null;
    
    public $sources = array();
    public $people = array();
    public $families = array();
    public $notes = array();
    public $repos = array();
    public $submitters = array();
    
    /**
     *
     */
    public function &createSource($identifier)
    {
        $this->sources[$identifier] = new Source();
        $this->sources[$identifier]->refId = $identifier;
        
        return $this->sources[$identifier];
    }
    
    
    /**
     *
     */
    public function &createSourceRepositoryCitation($identifier)
    {
        $citation = new SourceRepositoryCitation();
        $citation->repositoryId = $identifier;
        
        return $citation;
    }
    
    
    /**
     *
     */
    public function &createSourceCallNumber($identifier)
    {
        $caln = new SourceCallNumber();
        $caln->caln = $identifier;
        
        return $caln;
    }
    
    /**
     *
     */
    public function &createIndividual($identifier)
    {
        $this->people[$identifier] = new Individual();
        $this->people[$identifier]->refId = $identifier;
        
        return $this->people[$identifier];
    }
    
    
    /**
     *
     *
     */
    public function &createFamily($identifier)
    {
        $family = new Family();
        $family->refId = $identifier;
        
        $this->families[$identifier] = $family;
        
        return $family;
    }
    
    
    /**
     *
     *
     */
    public function &createNote($identifier = null)
    {
        $note = new Note();
        $note->refId = $identifier;
        
        $this->notes[] = $note;
        
        return $note;
    }
    
    /**
     *
     */
    public function addRepo(\Gedcom\Record\Repo &$repo)
    {
        $this->repos[] = &$repo;
    }
    
    /**
     *
     */
    public function addSubmitter(\Gedcom\Record\Submitter &$subm)
    {
        $this->submitters[] = &$subm;
    }
    
    /**
     *
     *
     */
    public function &findPerson($identifier)
    {
        if(isset($this->people[$identifier]))
            return $this->people[$identifier];
        
        return null;
    }
    
    
    /**
     *
     */
    public static function parseFile($fileName)
    {
        $parser = new Parser();
        $gedcom = $parser->parseFile($fileName);
        
        echo '<pre>' . print_r($parser->getErrors(), true) . '</pre>';
        
        return $gedcom;
    }
}
