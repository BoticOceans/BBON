<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'requirement_type',
        'product_category',
        'quantity',
        'customisation',
        'message',
        'channel',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function summaryText(): string
    {
        $lines = [
            "New enquiry from {$this->name}",
            "Phone: {$this->phone}",
        ];

        if ($this->email) {
            $lines[] = "Email: {$this->email}";
        }
        if ($this->requirement_type) {
            $lines[] = "Requirement: {$this->requirement_type}";
        }
        if ($this->product_category) {
            $lines[] = "Product: {$this->product_category}";
        }
        if ($this->quantity) {
            $lines[] = "Quantity: {$this->quantity}";
        }
        if ($this->customisation) {
            $lines[] = "Customisation: {$this->customisation}";
        }
        if ($this->message) {
            $lines[] = "Message: {$this->message}";
        }

        return implode("\n", $lines);
    }
}
