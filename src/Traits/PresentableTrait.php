<?php

namespace Zenekp\LaravelEloquentPresenter\Traits;

use RuntimeException;
use Zenekp\ArrayAccessPresenter\Factories\PresenterFactory;
use Zenekp\ArrayAccessPresenter\Interfaces\PresenterInterface;

trait PresentableTrait
{
    /**
     * @var ?PresenterInterface
     */
    protected ?PresenterInterface $presenterInstance = null;

    /**
     * @return PresenterInterface
     */
    public function present(): PresenterInterface
    {
        if ( ! $this->presenterInstance instanceof PresenterInterface) {
            $presenterClass = $this->getPresenterClass();
            return PresenterFactory::decorate($this->toArray(), $presenterClass);
        }

        return $this->presenterInstance;
    }

    /**
     * @return string
     */
    protected function getPresenterClass(): string
    {
        if (property_exists($this, 'presenter')) {
            return $this->presenter;
        }

        throw new RuntimeException('Please define a $presenter property in your model.');
    }
}
