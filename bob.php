<?php

class Bob
{
    /**
     * private vars.
     */
    private $answers;

    private $mostOfCases;

    private $aggressiveQuestion;

    private $ignoreNumbers;

    /**
     * arrays setters.
     */
    private function setMostOfCases()
    {
        return $this->mostOfCases = array(' ', '!', ',', '%', '^', '*', '@', '#', '$', '(',);
    }

    private function setAggressiveQuestion()
    {
        return $this->aggressiveQuestion = array(' ', '?',);
    }

    private function setIgnoreNumbers()
    {
        return $this->ignoreNumbers = array('/[0-9]+/');
    }

    private function endsWith($string, $endString)
    {
        $len = strlen($endString);
        if ($len == 0) {
            return true;
        }
        return (substr($string, -$len) === $endString);
    }

    /**
     * ignore for most of the cases.
     */
    private function ignoreStuff($phrase)
    {
        $this->setMostOfCases();
        $this->setIgnoreNumbers();

        $phrase = str_replace($this->mostOfCases,  '', $phrase);
        $phrase = preg_replace($this->ignoreNumbers, '', $phrase);

        return $phrase;
    }

    /**
     * Set All answers.
     */
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

    /**
     * Respond to all questions.
     */
    public function respondTo($conversation)
    {
        $this->setAnswers();

        if ($this->endsWith($this->ignoreStuff($conversation), '?') !== false)
        {

            $this->setAggressiveQuestion();

            $conversation = str_replace($this->aggressiveQuestion, '', $conversation);

            /**
             * Respond to aggressiveQuestions or to a question.
             */
            if (ctype_upper($conversation))
            {

                return $this->answers['aggressiveQuestion'];

            } else {

                return $this->answers['question'];

            }
        }

        /**
         * Respond to aggressive conversations without "!"
         */
        if (ctype_upper($this->ignoreStuff($conversation)))
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
    }
}