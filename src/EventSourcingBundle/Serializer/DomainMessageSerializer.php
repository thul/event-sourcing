<?php

namespace Simgroep\EventSourcing\EventSourcingBundle\Serializer;

class DomainMessageSerializer extends AbstractObjectSerializer
{
    public function __construct()
    {
        parent::__construct(
            function($subject, array &$data, SerializerInterface $serializer) {
                $data['playhead'] = (int) $subject->playhead;
                $data['metadata'] = isset($subject->metadata) ? $serializer->serialize($subject->metadata) : null;
                $data['id'] = (string) $subject->id;
                $data['recordedOn'] = isset($subject->recordedOn) ? $serializer->serialize($subject->recordedOn) : null;
                $data['payload'] = isset($subject->payload) ? $serializer->serialize($subject->payload) : null;
            },
            function($subject, array &$data, SerializerInterface $serializer) {
                $subject->playhead = (int) $data['playhead'];
                $subject->metadata = isset($data['metadata']) ? $serializer->deserialize('Broadway\Domain\Metadata', $data['metadata']) : null;
                $subject->id = (string) $data['id'];
                $subject->recordedOn = isset($data['recordedOn']) ? $serializer->deserialize('Broadway\Domain\DateTime', $data['recordedOn']) : null;
                $subject->payload = isset($data['payload']) ? $serializer->deserialize(null, $data['payload']) : null;
            },
            'Broadway\Domain\DomainMessage'
        );
    }
}