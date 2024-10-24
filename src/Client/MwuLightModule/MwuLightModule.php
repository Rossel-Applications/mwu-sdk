<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Client\MwuLightModule;

use Rossel\MwuSdk\Builder\Command\Write\WriteCommandBuilderInterface;
use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use Rossel\MwuSdk\Exception\Client\LightModule\UnreachableLightModuleException;
use Rossel\MwuSdk\Model\DisplayStatus;
use Rossel\MwuSdk\Model\DisplayStatusInterface;
use Rossel\MwuSdk\Model\FnButton;
use Rossel\MwuSdk\Model\FnButtonInterface;
use Rossel\MwuSdk\Model\QuantityKeys;
use Rossel\MwuSdk\Model\QuantityKeysInterface;

/**
 * This class is responsible for managing interactions with individual MWU light modules.
 * It provides methods to send specific commands to a light module.
 */
final class MwuLightModule implements MwuLightModuleInterface
{
    private const DEFAULT_TEXT_MAX_LENGTH = 4;

    private ?MwuSwitchInterface $switch;
    private ?int $id = null;
    private DisplayStatusInterface $displayStatus;
    private DisplayStatusInterface $displayStatusAfterConfirm;
    private DisplayStatusInterface $displayStatusAfterFn;
    private FnButtonInterface $fnButton;
    private QuantityKeysInterface $quantityKeys;
    private int $textMaxLength = self::DEFAULT_TEXT_MAX_LENGTH;

    public function __construct(
        MwuSwitchInterface $switch,
        int $id,
        ?BehaviorConfigInterface $behaviorConfig = null,
    ) {
        $this
            ->connectSwitch($switch, $id)
            ->setDisplayStatus($behaviorConfig?->getDisplayStatus() ?? new DisplayStatus())
            ->setDisplayStatusAfterConfirm($behaviorConfig?->getDisplayStatusAfterConfirm() ?? new DisplayStatus())
            ->setDisplayStatusAfterFn($behaviorConfig?->getDisplayStatusAfterFn() ?? new DisplayStatus())
            ->setFnButton($behaviorConfig?->getFnButton() ?? new FnButton())
            ->setQuantityKeys($behaviorConfig?->getQuantityKeys() ?? new QuantityKeys());
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getDisplayStatus(): DisplayStatusInterface
    {
        return $this->displayStatus;
    }

    /**
     * {@inheritDoc}
     */
    public function getDisplayStatusAfterFn(): DisplayStatusInterface
    {
        return $this->displayStatusAfterFn;
    }

    /**
     * {@inheritDoc}
     */
    public function getDisplayStatusAfterConfirm(): DisplayStatusInterface
    {
        return $this->displayStatusAfterConfirm;
    }

    /**
     * {@inheritDoc}
     */
    public function getSwitch(): ?MwuSwitchInterface
    {
        return $this->switch;
    }

    /**
     * {@inheritDoc}
     */
    public function getFnButton(): FnButtonInterface
    {
        return $this->fnButton;
    }

    /**
     * {@inheritDoc}
     */
    public function getQuantityKeys(): QuantityKeysInterface
    {
        return $this->quantityKeys;
    }

    /**
     * {@inheritDoc}
     */
    public function getTextMaxLength(): int
    {
        return $this->textMaxLength;
    }

    /**
     * {@inheritDoc}
     */
    public function setTextMaxLength(int $textMaxLength): self
    {
        $this->textMaxLength = $textMaxLength;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function connectSwitch(MwuSwitchInterface $switch, int $id): self
    {
        if ($switch->isLightModuleIdAvailable($id)) {
            $this
                ->setId($id)
                ->setSwitch($switch);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function disconnectSwitch(): self
    {
        $switch = $this->getSwitch();

        if (null !== $switch
            && \in_array($this, $switch->getLightModules(), true)
        ) {
            $switch->disconnectLightModule($this);
        }

        if (null !== $this->switch) {
            $this->setSwitch(null);
        }

        if (null !== $this->id) {
            $this->setId(null);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function checkIfReachable(bool $throwErrors = false): bool
    {
        $switchDefined = null !== $this->getSwitch();
        $idDefined = null !== $this->getId();

        if (!$throwErrors) {
            return $switchDefined && $idDefined;
        }

        if (!$switchDefined) {
            throw new UnreachableLightModuleException($this, UnreachableLightModuleException::DETAILS_MISSING_SWITCH);
        }

        if (!$idDefined) {
            throw new UnreachableLightModuleException($this, UnreachableLightModuleException::DETAILS_MISSING_ID);
        }

        return true;
    }

    /**
     * {@inheritDoc}
     *
     * @return string|null the response from the Light Module, or null if the command could not be sent
     */
    public function write(
        WriteCommandBuilderInterface $commandBuilder,
        string $text = '',
    ): ?string {
        $this->checkIfReachable(true);

        /** @var MwuSwitchInterface $switch */
        $switch = $this->switch;

        $command = $commandBuilder->buildCommand($this, $text);

        return $switch->send($command);
    }

    private function setSwitch(?MwuSwitchInterface $switch): self
    {
        $switch?->connectLightModule($this);
        $this->switch = $switch;

        return $this;
    }

    private function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    private function setDisplayStatus(DisplayStatusInterface $displayStatus): self
    {
        $this->displayStatus = $displayStatus;

        return $this;
    }

    private function setDisplayStatusAfterConfirm(DisplayStatusInterface $displayStatusAfterConfirm): self
    {
        $this->displayStatusAfterConfirm = $displayStatusAfterConfirm;

        return $this;
    }

    private function setDisplayStatusAfterFn(DisplayStatusInterface $displayStatusAfterFn): self
    {
        $this->displayStatusAfterFn = $displayStatusAfterFn;

        return $this;
    }

    private function setFnButton(FnButtonInterface $fnButton): self
    {
        $this->fnButton = $fnButton;

        return $this;
    }

    private function setQuantityKeys(QuantityKeysInterface $quantityKeys): self
    {
        $this->quantityKeys = $quantityKeys;

        return $this;
    }
}
