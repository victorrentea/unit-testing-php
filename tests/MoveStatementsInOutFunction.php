<?php


namespace PhpUnitWorkshopTest;


class MoveStatementsInOutFunction
{
    function f(Person $person)
    {
        $result = [];
        $result [] = "<p>title: " . $person->photo->title . "</p>";
        $result += $this->photoData($person->photo);
        // 50 more lines NOT related to photo
        return $result;
    }

    function photoData(Photo $photo)
    {
        return [
            '<p>location: ' . ${$photo->location} . '</p>',
            '<p>date: ' . ${$photo->date} . '</p>',
        ];
    }
}

class Person
{
    /** @var Photo */
    public $photo;
}

class Photo
{
    public $location;
    public $date;
    public $title;
}