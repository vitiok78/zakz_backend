<?php

namespace App\Entity;

use App\Repository\BatchRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BatchRepository::class)]
class Batch
{
    public const STATUS_DEFAULT = 1;
    public const NUM_BATCH_LENGTH = 15;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP', 'comment' => 'Дата багажа'])]
    private DateTimeInterface $shipmentDate;

    #[ORM\Column(type: 'datetime', nullable: true, options: ['default' => 'CURRENT_TIMESTAMP', 'comment' => 'Дата создания багажа'])]
    private ?DateTimeInterface $dateCreate;

    #[ORM\Column(type: 'datetime', nullable: true, options: ['comment' => 'Дата удаления багажа'])]
    private ?DateTimeInterface $dateDelete;

    #[ORM\Column(type: 'smallint', nullable: true, options: ['default' => 1, 'comment' => 'Статус багажа'])]
    private ?int $status = self::STATUS_DEFAULT;

    #[ORM\Column(type: 'string', length: self::NUM_BATCH_LENGTH, options: ['comment' => 'Номер багажа'])]
    private string $numBatch = '';

    public function __construct()
    {
        $dateCurrent = new DateTime();
        $this->shipmentDate = $dateCurrent;
        $this->dateCreate = clone $dateCurrent;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShipmentDate(): ?\DateTimeInterface
    {
        return $this->shipmentDate;
    }

    public function setShipmentDate(\DateTimeInterface $shipmentDate): self
    {
        $this->shipmentDate = $shipmentDate;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(?\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    public function getDateDelete(): ?\DateTimeInterface
    {
        return $this->dateDelete;
    }

    public function setDateDelete(?\DateTimeInterface $dateDelete): self
    {
        $this->dateDelete = $dateDelete;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNumBatch(): ?string
    {
        return $this->numBatch;
    }

    public function setNumBatch(string $numBatch): self
    {
        $this->numBatch = $numBatch;

        return $this;
    }
}
