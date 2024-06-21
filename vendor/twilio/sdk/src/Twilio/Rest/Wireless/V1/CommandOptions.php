<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Wireless
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Wireless\V1;

use Twilio\Options;
use Twilio\Values;

abstract class CommandOptions
{
    /**
     * @param string $sim The `sid` or `unique_name` of the [SIM](https://www.twilio.com/docs/iot/wireless/api/sim-resource) to send the Command to.
     * @param string $callbackMethod The HTTP method we use to call `callback_url`. Can be: `POST` or `GET`, and the default is `POST`.
     * @param string $callbackUrl The URL we call using the `callback_url` when the Command has finished sending, whether the command was delivered or it failed.
     * @param string $commandMode
     * @param string $includeSid Whether to include the SID of the command in the message body. Can be: `none`, `start`, or `end`, and the default behavior is `none`. When sending a Command to a SIM in text mode, we can automatically include the SID of the Command in the message body, which could be used to ensure that the device does not process the same Command more than once.  A value of `start` will prepend the message with the Command SID, and `end` will append it to the end, separating the Command SID from the message body with a space. The length of the Command SID is included in the 160 character limit so the SMS body must be 128 characters or less before the Command SID is included.
     * @param bool $deliveryReceiptRequested Whether to request delivery receipt from the recipient. For Commands that request delivery receipt, the Command state transitions to 'delivered' once the server has received a delivery receipt from the device. The default value is `true`.
     * @return CreateCommandOptions Options builder
     */
    public static function create(
        
        string $sim = Values::NONE,
        string $callbackMethod = Values::NONE,
        string $callbackUrl = Values::NONE,
        string $commandMode = Values::NONE,
        string $includeSid = Values::NONE,
        bool $deliveryReceiptRequested = Values::BOOL_NONE

    ): CreateCommandOptions
    {
        return new CreateCommandOptions(
            $sim,
            $callbackMethod,
            $callbackUrl,
            $commandMode,
            $includeSid,
            $deliveryReceiptRequested
        );
    }



    /**
     * @param string $sim The `sid` or `unique_name` of the [Sim resources](https://www.twilio.com/docs/iot/wireless/api/sim-resource) to read.
     * @param string $status The status of the resources to read. Can be: `queued`, `sent`, `delivered`, `received`, or `failed`.
     * @param string $direction Only return Commands with this direction value.
     * @param string $transport Only return Commands with this transport value. Can be: `sms` or `ip`.
     * @return ReadCommandOptions Options builder
     */
    public static function read(
        
        string $sim = Values::NONE,
        string $status = Values::NONE,
        string $direction = Values::NONE,
        string $transport = Values::NONE

    ): ReadCommandOptions
    {
        return new ReadCommandOptions(
            $sim,
            $status,
            $direction,
            $transport
        );
    }

}

class CreateCommandOptions extends Options
    {
    /**
     * @param string $sim The `sid` or `unique_name` of the [SIM](https://www.twilio.com/docs/iot/wireless/api/sim-resource) to send the Command to.
     * @param string $callbackMethod The HTTP method we use to call `callback_url`. Can be: `POST` or `GET`, and the default is `POST`.
     * @param string $callbackUrl The URL we call using the `callback_url` when the Command has finished sending, whether the command was delivered or it failed.
     * @param string $commandMode
     * @param string $includeSid Whether to include the SID of the command in the message body. Can be: `none`, `start`, or `end`, and the default behavior is `none`. When sending a Command to a SIM in text mode, we can automatically include the SID of the Command in the message body, which could be used to ensure that the device does not process the same Command more than once.  A value of `start` will prepend the message with the Command SID, and `end` will append it to the end, separating the Command SID from the message body with a space. The length of the Command SID is included in the 160 character limit so the SMS body must be 128 characters or less before the Command SID is included.
     * @param bool $deliveryReceiptRequested Whether to request delivery receipt from the recipient. For Commands that request delivery receipt, the Command state transitions to 'delivered' once the server has received a delivery receipt from the device. The default value is `true`.
     */
    public function __construct(
        
        string $sim = Values::NONE,
        string $callbackMethod = Values::NONE,
        string $callbackUrl = Values::NONE,
        string $commandMode = Values::NONE,
        string $includeSid = Values::NONE,
        bool $deliveryReceiptRequested = Values::BOOL_NONE

    ) {
        $this->options['sim'] = $sim;
        $this->options['callbackMethod'] = $callbackMethod;
        $this->options['callbackUrl'] = $callbackUrl;
        $this->options['commandMode'] = $commandMode;
        $this->options['includeSid'] = $includeSid;
        $this->options['deliveryReceiptRequested'] = $deliveryReceiptRequested;
    }

    /**
     * The `sid` or `unique_name` of the [SIM](https://www.twilio.com/docs/iot/wireless/api/sim-resource) to send the Command to.
     *
     * @param string $sim The `sid` or `unique_name` of the [SIM](https://www.twilio.com/docs/iot/wireless/api/sim-resource) to send the Command to.
     * @return $this Fluent Builder
     */
    public function setSim(string $sim): self
    {
        $this->options['sim'] = $sim;
        return $this;
    }

    /**
     * The HTTP method we use to call `callback_url`. Can be: `POST` or `GET`, and the default is `POST`.
     *
     * @param string $callbackMethod The HTTP method we use to call `callback_url`. Can be: `POST` or `GET`, and the default is `POST`.
     * @return $this Fluent Builder
     */
    public function setCallbackMethod(string $callbackMethod): self
    {
        $this->options['callbackMethod'] = $callbackMethod;
        return $this;
    }

    /**
     * The URL we call using the `callback_url` when the Command has finished sending, whether the command was delivered or it failed.
     *
     * @param string $callbackUrl The URL we call using the `callback_url` when the Command has finished sending, whether the command was delivered or it failed.
     * @return $this Fluent Builder
     */
    public function setCallbackUrl(string $callbackUrl): self
    {
        $this->options['callbackUrl'] = $callbackUrl;
        return $this;
    }

    /**
     * @param string $commandMode
     * @return $this Fluent Builder
     */
    public function setCommandMode(string $commandMode): self
    {
        $this->options['commandMode'] = $commandMode;
        return $this;
    }

    /**
     * Whether to include the SID of the command in the message body. Can be: `none`, `start`, or `end`, and the default behavior is `none`. When sending a Command to a SIM in text mode, we can automatically include the SID of the Command in the message body, which could be used to ensure that the device does not process the same Command more than once.  A value of `start` will prepend the message with the Command SID, and `end` will append it to the end, separating the Command SID from the message body with a space. The length of the Command SID is included in the 160 character limit so the SMS body must be 128 characters or less before the Command SID is included.
     *
     * @param string $includeSid Whether to include the SID of the command in the message body. Can be: `none`, `start`, or `end`, and the default behavior is `none`. When sending a Command to a SIM in text mode, we can automatically include the SID of the Command in the message body, which could be used to ensure that the device does not process the same Command more than once.  A value of `start` will prepend the message with the Command SID, and `end` will append it to the end, separating the Command SID from the message body with a space. The length of the Command SID is included in the 160 character limit so the SMS body must be 128 characters or less before the Command SID is included.
     * @return $this Fluent Builder
     */
    public function setIncludeSid(string $includeSid): self
    {
        $this->options['includeSid'] = $includeSid;
        return $this;
    }

    /**
     * Whether to request delivery receipt from the recipient. For Commands that request delivery receipt, the Command state transitions to 'delivered' once the server has received a delivery receipt from the device. The default value is `true`.
     *
     * @param bool $deliveryReceiptRequested Whether to request delivery receipt from the recipient. For Commands that request delivery receipt, the Command state transitions to 'delivered' once the server has received a delivery receipt from the device. The default value is `true`.
     * @return $this Fluent Builder
     */
    public function setDeliveryReceiptRequested(bool $deliveryReceiptRequested): self
    {
        $this->options['deliveryReceiptRequested'] = $deliveryReceiptRequested;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Wireless.V1.CreateCommandOptions ' . $options . ']';
    }
}



class ReadCommandOptions extends Options
    {
    /**
     * @param string $sim The `sid` or `unique_name` of the [Sim resources](https://www.twilio.com/docs/iot/wireless/api/sim-resource) to read.
     * @param string $status The status of the resources to read. Can be: `queued`, `sent`, `delivered`, `received`, or `failed`.
     * @param string $direction Only return Commands with this direction value.
     * @param string $transport Only return Commands with this transport value. Can be: `sms` or `ip`.
     */
    public function __construct(
        
        string $sim = Values::NONE,
        string $status = Values::NONE,
        string $direction = Values::NONE,
        string $transport = Values::NONE

    ) {
        $this->options['sim'] = $sim;
        $this->options['status'] = $status;
        $this->options['direction'] = $direction;
        $this->options['transport'] = $transport;
    }

    /**
     * The `sid` or `unique_name` of the [Sim resources](https://www.twilio.com/docs/iot/wireless/api/sim-resource) to read.
     *
     * @param string $sim The `sid` or `unique_name` of the [Sim resources](https://www.twilio.com/docs/iot/wireless/api/sim-resource) to read.
     * @return $this Fluent Builder
     */
    public function setSim(string $sim): self
    {
        $this->options['sim'] = $sim;
        return $this;
    }

    /**
     * The status of the resources to read. Can be: `queued`, `sent`, `delivered`, `received`, or `failed`.
     *
     * @param string $status The status of the resources to read. Can be: `queued`, `sent`, `delivered`, `received`, or `failed`.
     * @return $this Fluent Builder
     */
    public function setStatus(string $status): self
    {
        $this->options['status'] = $status;
        return $this;
    }

    /**
     * Only return Commands with this direction value.
     *
     * @param string $direction Only return Commands with this direction value.
     * @return $this Fluent Builder
     */
    public function setDirection(string $direction): self
    {
        $this->options['direction'] = $direction;
        return $this;
    }

    /**
     * Only return Commands with this transport value. Can be: `sms` or `ip`.
     *
     * @param string $transport Only return Commands with this transport value. Can be: `sms` or `ip`.
     * @return $this Fluent Builder
     */
    public function setTransport(string $transport): self
    {
        $this->options['transport'] = $transport;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Wireless.V1.ReadCommandOptions ' . $options . ']';
    }
}

