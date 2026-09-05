<?php 

namespace App\Enums\Admin;

enum DepartmentEnum: string
{
    case HR = 'hr';
    case IT = 'it';
    case FINANCE = 'finance';
    case SALES = 'sales';
    case MARKETING = 'marketing';
}