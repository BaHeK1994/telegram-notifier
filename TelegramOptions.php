<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Notifier\Bridge\Telegram;

use Symfony\Component\Notifier\Bridge\Telegram\Reply\Markup\AbstractTelegramReplyMarkup;
use Symfony\Component\Notifier\Message\MessageOptionsInterface;

/**
 * @author Mihail Krasilnikov <mihail.krasilnikov.j@gmail.com>
 */
final class TelegramOptions implements MessageOptionsInterface
{
    public const PARSE_MODE_HTML = 'HTML';
    public const PARSE_MODE_MARKDOWN = 'Markdown';
    public const PARSE_MODE_MARKDOWN_V2 = 'MarkdownV2';

    /**
     * @var array
     */
    private $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function toArray(): array
    {
        return $this->options;
    }

    public function getRecipientId(): ?string
    {
        return $this->options['chat_id'] ?? null;
    }

    /**
     * @return $this
     */
    public function chatId(string $id): self
    {
        $this->options['chat_id'] = $id;

        return $this;
    }

    /**
     * @return $this
     */
    public function parseMode(string $mode): self
    {
        $this->options['parse_mode'] = $mode;

        return $this;
    }

    /**
     * @return $this
     */
    public function disableWebPagePreview(bool $bool): self
    {
        $this->options['disable_web_page_preview'] = $bool;

        return $this;
    }

    /**
     * @return $this
     */
    public function disableNotification(bool $bool): self
    {
        $this->options['disable_notification'] = $bool;

        return $this;
    }

    /**
     * @return $this
     */
    public function replyTo(int $messageId): self
    {
        $this->options['reply_to_message_id'] = $messageId;

        return $this;
    }

    /**
     * @return $this
     */
    public function replyMarkup(AbstractTelegramReplyMarkup $markup): self
    {
        $this->options['reply_markup'] = $markup->toArray();

        return $this;
    }

    /**
     * @return $this
     */
    public function setMethod(string $method): self
    {
        $this->options['method'] = $method;

        return $this;
    }

    /**
     * @return $this
     */
    public function setCallBackQueryId(string $callBackQueryId): self
    {
        $this->options['callback_query_id'] = $callBackQueryId;

        return $this;
    }

    public function setUserToken(?string $token = null): self
    {
        if ($token !== null) {
            $this->options['user_token'] = $token;
        } else {
            unset($this->options['user_token']);
        }

        return $this;
    }

    public function __set(string $key, $value)
    {
        $this->options[$key] = $value;
    }

    public function __get(string $key)
    {
        return $this->options[$key] ?? null;
    }

    public function __unset(string $key)
    {
        unset($this->options[$key]);
    }
}
