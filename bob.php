<?php

class Bob
{

    private $answers;

    private function endsWith($string, $endString)
    {
        $len = strlen($endString);
        if ($len == 0) {
            return true;
        }
        return (substr($string, -$len) === $endString);
    }

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

        if ($this->endsWith($conversation, '?') !== false && ctype_upper($conversation))
        {
            return $this->answers['aggressiveQuestion'];
        }

        /**
         * Respond to questions.
         */
        if ($this->endsWith($conversation, '?') !== false )
        {
            return $this->answers['question'];
        }

        /**
         * Respond to aggressive conversations without "!"
         */
        if (ctype_upper($conversation))
        {
            return $this->answers['aggressive'];
        }

        /**
         * Respond to aggressive conversations with "!".
         */
        if ($this->endsWith($conversation, '!') !== false )
        {
            return $this->answers['aggressive'];
        }

        /**
         * Respond to silence.
         */
        if (ctype_space($conversation))
        {
            return $this->answers['silence'];
        }

        /**
         * Respond to empty string.
         */
        if (empty($conversation))
        {
            return $this->answers['silence'];
        }

        /**
         * Respond to anyThingElse
         */
        return $this->answers['anythingElse'];

//        if (preg_match('/\\\b?\b/', $conversation))
//        {
//            return $this->answers['question'];
//        }

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