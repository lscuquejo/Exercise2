<?php

class Bob
{

    private $answers;

    private function setAnswers()
    {
        return $this->answers = array(
            "question"              =>  "Sure.",
            "aggressive"            =>  "Whoa, chill out!",
            "aggressiveQuestion"    =>  "Calm down, I know what I'm doing!",
            "silence"               =>  "Fine. Be that way!",
            "anythingElse"          =>  "Whatever.",
        );
    }

    public function respondTo($conversation)
    {
        $this->setAnswers();

        if (ctype_upper($conversation))
        {
            return $this->answers['aggressive'];
        }

//TODO First attempt just works one test.
//
//        if ($conversation === "Tom-ay-to, tom-aaaah-to."){
//
//            $response = "Whatever.";
//
//            return $response;
//
//        }
    }
}