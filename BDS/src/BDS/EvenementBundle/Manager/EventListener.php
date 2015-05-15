<?php 
namespace BDS\EvenementBundle\Manager\EventListener;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use Doctrine\ORM\EntityManager;
use BDS\EvenementBundle\Entity\Evenement;

class CalendarEventListener
{
	private $em;
	
	private $eventManager;

	public function __construct(EntityManager $em, $eventManager)
	{
		$this->em = $em;
		
		$this->eventManager = $eventManager;
		
	}

	public function loadEvents(CalendarEvent $calendarEvent)
	{
		$evenements = $this->eventManager->getAll();
		
		foreach($evenements as $evenement) {

		// create an event with a start/end time, or an all day event
			$eventEntity = new EventEntity($evenement->getNom(), $evenement->getDebutEvenement(), $evenement->getFinEvenement());

			/*optional calendar event settings
			$eventEntity->setAllDay(true); // default is false, set to true if this is an all day event
			$eventEntity->setBgColor('#FF0000'); //set the background color of the event's label
			$eventEntity->setFgColor('#FFFFFF'); //set the foreground color of the event's label
			$eventEntity->setUrl('http://www.google.com'); // url to send user to when event label is clicked
			$eventEntity->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels
			*/
			//finally, add the event to the CalendarEvent for displaying on the calendar
					$calendarEvent->addEvent($eventEntity);
		}
	}
}