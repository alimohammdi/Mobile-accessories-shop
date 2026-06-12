<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    public function handle(Request $request)
    {
        $update = Telegram::getWebhookUpdate();
        $message = $update->getMessage();

        if (!$message) return response('ok');

        $chatId = $message->getChat()->getId();
        $text = $message->getText();

        // فقط ادمین دسترسی داره
        if ($chatId != config('telegram.admin_chat_id')) {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => '⛔ شما دسترسی ندارید.',
            ]);
            return response('ok');
        }

        $this->handleCommand($chatId, $text);

        return response('ok');
    }

    private function handleCommand($chatId, $text)
    {
        match(true) {
            str_starts_with($text, '/start')   => $this->sendMainMenu($chatId),
            str_starts_with($text, '/orders')  => $this->sendOrdersList($chatId),
            str_starts_with($text, '/stats')   => $this->sendStats($chatId),
            str_starts_with($text, '/products')=> $this->sendProducts($chatId),
            default                            => $this->sendMainMenu($chatId),
        };
    }

    private function sendMainMenu($chatId)
    {
        $keyboard = [
            ['📦 سفارش‌ها', '📊 آمار فروش'],
            ['💬 کامنت‌ها', '🛍 محصولات'],
        ];

        Telegram::sendMessage([
            'chat_id'      => $chatId,
            'text'         => "🏠 *منوی اصلی*\nیک گزینه انتخاب کنید:",
            'parse_mode'   => 'Markdown',
            'reply_markup' => json_encode([
                'keyboard'          => $keyboard,
                'resize_keyboard'   => true,
                'one_time_keyboard' => false,
            ]),
        ]);
    }

    private function sendOrdersList($chatId)
    {
        // این رو در مرحله بعد کامل میکنیم
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text'    => '📦 در حال بارگذاری سفارش‌ها...',
        ]);
    }

    private function sendStats($chatId)
    {
        // این رو در مرحله بعد کامل میکنیم
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text'    => '📊 در حال بارگذاری آمار...',
        ]);
    }

    private function sendProducts($chatId)
    {
        // این رو در مرحله بعد کامل میکنیم
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text'    => '🛍 در حال بارگذاری محصولات...',
        ]);
    }
}
