<?php
// Кэш изображений

namespace TexAdmin\Entities;

use TexAdmin\Enums\ImageCacheType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'image_cache')]
class ImageCache {
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    // Тип изображения (оценки/расписание/...) см. TexAdmin\Enums\ImageCacheType
    #[ORM\Column(type: 'integer')]
    private int $cache_type;
    
    // Платформа на которую загружено изображение
    #[ORM\ManyToOne(Platform::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Platform $platform;

    // Ключ
    #[ORM\Column(type: 'string', length: 128)]
    private string $search;

    // Значение
    #[ORM\Column(type: 'string', length: 256)]
    private string $value;
    
    // Дата создания
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $created_at;

    // Можно ли использовать
    #[ORM\Column(type: 'integer')]
    private int $valid = 1;
    
    #region setters
    public function setCacheType(ImageCacheType $cache_type) {
        $this->cache_type = $cache_type->value;
    }
    
    public function setPlatform(Platform $platform) {
        $this->platform = $platform;
    }
    
    public function setSearch(string $search) {
        $this->search = $search;
    }
    
    public function setValue(string $value) {
        $this->value = $value;
    }
    
    public function setCreatedAt(\DateTimeImmutable $datetime) {
        $this->created_at = $datetime;
    }
    
    public function setIsValid(bool $valid) {
        $this->valid = $valid;
    }
    #endregion

    #region getters
    public function getValue() : string {
        return $this->value;
    }
    #endregion
}
