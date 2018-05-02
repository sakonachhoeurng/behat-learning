<?php

use Behat\MinkExtension\Context\MinkContext;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Element\NodeElement;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }
    
    /**
     * Wait a number of seconds
     * Example: When I wait for "2" seconds
     *
     * @When /^I wait for "([^"]*)" seconds$/
     *
     * @param $num
     */
    public function iWaitForSeconds($num)
    {
        /** @var int $num */
        $this->iWaitForMilliseconds($num * 1000);
    }

    /**
     * Wait a number of milliseconds
     * Example: When I wait for "200" milliseconds
     *
     * @When /^I wait for "([^"]*)" milliseconds$/
     *
     * @param $num
     */
    public function iWaitForMilliseconds($num)
    {
        $session = $this->getSession();

        if ($session->getDriver() instanceof Selenium2Driver) {
            $this->getSession()->wait($num);
        }
    }

    /**
     * Example: When I switch to iframe "test-iframe" selector
     * @When /^I switch to iframe "([^"]*)" selector$/
     *
     * @param $iframeSelector
     * @throws Exception
     * @throws \Behat\Mink\Exception\DriverException
     * @throws \Behat\Mink\Exception\UnsupportedDriverActionException
     */
    public function switchToIFrame($iframeSelector){

        $function = <<<JS
            (function(){
                 var iframe = document.querySelector("$iframeSelector");
                 iframe.name = "iframeToSwitchTo";
            })()
JS;
        try{
            $this->getSession()->executeScript($function);
        }catch (Exception $e){
            print_r($e->getMessage());
            throw new \Exception("Element $iframeSelector was NOT found.".PHP_EOL . $e->getMessage());
        }

        $this->getSession()->getDriver()->switchToIFrame("iframeToSwitchTo");
    }

    /**
     * Click on the element with the provided css selector
     * Example: When I click on the element "nav ul li a"
     *
     * @When /^I click on the element "([^"]*)"$/
     *
     * @param $selector
     *
     * @throws \Exception
     */
    public function iClickOnElement($selector)
    {
        $element = $this->getSession()->getPage()->find('css', $selector);

        if (empty($element)) {
            throw new \Exception(sprintf("The element with css '%s' selector does not exist.", $selector));
        }

        $element->click();
    }

    /**
     * Example: I follow the "1" of link "selector"
     *
     * @When /^I follow the "([^"]*)" of selector "([^"]*)"$/
     *
     * @param $nth
     * @param $selector
     *
     * @throws \Exception
     */
    public function iFollowTheNthText($nth, $selector)
    {
        $selector = $this->fixStepArgument($selector);
        $links = $this->getSession()->getPage()->findAll('css', $selector);

        if (empty($links)) {
            throw new \Exception(sprintf("The element with css '%s' selector does not exist.", $selector));
        }

        if ($nth < 1 || $nth > count($links)) {
            throw new \Exception(sprintf("Index '%s' is out of range. The element index starts from 1.", $nth));
        }

        /** @var NodeElement $link */
        $link = $links[$nth - 1];
        $link->click();
    }
}
