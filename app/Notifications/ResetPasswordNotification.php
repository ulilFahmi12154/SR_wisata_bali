<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends BaseResetPassword
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Reset Password Jelajah Bali')
            ->greeting('Halo!')
            ->line('Anda menerima email ini karena ada permintaan reset password untuk akun Anda.')
            ->line('Klik tombol di bawah untuk mengatur ulang password.')
            ->action('Atur Ulang Password', $this->resetUrl($notifiable))
            ->line('Jika Anda tidak merasa meminta reset password, abaikan email ini.');
    }
}
