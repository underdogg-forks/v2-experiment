<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Company.
 *
 * @property int                            $id
 * @property string                         $search_code
 * @property string                         $name
 * @property string                         $slug
 * @property string|null                    $vat_number
 * @property string|null                    $id_number
 * @property string|null                    $coc_number
 * @property string|null                    $logo
 * @property string|null                    $quote_template
 * @property string|null                    $invoice_template
 * @property Collection|ClientCustom[]      $client_customs
 * @property Collection|Client[]            $clients
 * @property Collection|CustomField[]       $custom_fields
 * @property Collection|CustomValue[]       $custom_values
 * @property Collection|ExpenseCategory[]   $expense_categories
 * @property Collection|ExpenseItem[]       $expense_items
 * @property Collection|Expense[]           $expenses
 * @property Collection|InvoiceAmount[]     $invoice_amounts
 * @property Collection|InvoiceCustom[]     $invoice_customs
 * @property Collection|InvoiceGroup[]      $invoice_groups
 * @property Collection|InvoiceItemAmount[] $invoice_item_amounts
 * @property Collection|InvoiceItem[]       $invoice_items
 * @property Collection|InvoiceSumex[]      $invoice_sumexes
 * @property Collection|InvoiceTaxRate[]    $invoice_tax_rates
 * @property Collection|Invoice[]           $invoices
 * @property Collection|InvoicesRecurring[] $invoices_recurrings
 * @property Collection|ItemLookup[]        $item_lookups
 * @property Collection|MerchantResponse[]  $merchant_responses
 * @property Collection|PaymentCustom[]     $payment_customs
 * @property Collection|Payment[]           $payments
 * @property Collection|Product[]           $products
 * @property Collection|Project[]           $projects
 * @property Collection|QuoteAmount[]       $quote_amounts
 * @property Collection|QuoteCustom[]       $quote_customs
 * @property Collection|QuoteItemAmount[]   $quote_item_amounts
 * @property Collection|QuoteItem[]         $quote_items
 * @property Collection|QuoteTaxRate[]      $quote_tax_rates
 * @property Collection|Quote[]             $quotes
 * @property Collection|Setting[]           $settings
 * @property Collection|Task[]              $tasks
 * @property Collection|TaxRate[]           $tax_rates
 * @property Collection|Unit[]              $units
 * @property Collection|Upload[]            $uploads
 * @property Collection|UserClient[]        $user_clients
 * @property Collection|UserCustom[]        $user_customs
 */
class Company extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'companies';

    protected $fillable = [
        'search_code',
        'name',
        'slug',
        'vat_number',
        'id_number',
        'coc_number',
        'logo',
        'quote_template',
        'invoice_template',
    ];

    public function client_customs()
    {
        return $this->hasMany(ClientCustom::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function custom_fields()
    {
        return $this->hasMany(CustomField::class);
    }

    public function custom_values()
    {
        return $this->hasMany(CustomValue::class);
    }

    public function expense_categories()
    {
        return $this->hasMany(ExpenseCategory::class);
    }

    public function expense_items()
    {
        return $this->hasMany(ExpenseItem::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function invoice_amounts()
    {
        return $this->hasMany(InvoiceAmount::class);
    }

    public function invoice_customs()
    {
        return $this->hasMany(InvoiceCustom::class);
    }

    public function invoice_groups()
    {
        return $this->hasMany(InvoiceGroup::class);
    }

    public function invoice_item_amounts()
    {
        return $this->hasMany(InvoiceItemAmount::class);
    }

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function invoice_sumexes()
    {
        return $this->hasMany(InvoiceSumex::class);
    }

    public function invoice_tax_rates()
    {
        return $this->hasMany(InvoiceTaxRate::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoices_recurrings()
    {
        return $this->hasMany(InvoicesRecurring::class);
    }

    public function item_lookups()
    {
        return $this->hasMany(ItemLookup::class);
    }

    public function merchant_responses()
    {
        return $this->hasMany(MerchantResponse::class);
    }

    public function payment_customs()
    {
        return $this->hasMany(PaymentCustom::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function quote_amounts()
    {
        return $this->hasMany(QuoteAmount::class);
    }

    public function quote_customs()
    {
        return $this->hasMany(QuoteCustom::class);
    }

    public function quote_item_amounts()
    {
        return $this->hasMany(QuoteItemAmount::class);
    }

    public function quote_items()
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function quote_tax_rates()
    {
        return $this->hasMany(QuoteTaxRate::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function tax_rates()
    {
        return $this->hasMany(TaxRate::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }

    public function user_clients()
    {
        return $this->hasMany(UserClient::class);
    }

    public function user_customs()
    {
        return $this->hasMany(UserCustom::class);
    }
}
