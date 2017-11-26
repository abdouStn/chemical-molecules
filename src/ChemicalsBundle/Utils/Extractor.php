<?php

namespace ChemicalsBundle\Utils;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Extractor.
 *
 * @author Aurélien Muller
 */
abstract class Extractor
{
    protected static $serializer = null;

    /**
     * Serialize an item.
     *
     * @param type $format
     *
     * @return type
     */
    public function serialize($format = 'json')
    {
        if (empty(self::$serializer)) {
            $this->setUp();
        }
        return self::$serializer->serialize($this, $format);
    }

    /**
     * Sets up dynamically these elements.
     */
    protected function setUp()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        // Use it to handle circular references (association between
        // entities).
        $normalizers[0]->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        self::$serializer = new Serializer($normalizers, $encoders);
    }
}
