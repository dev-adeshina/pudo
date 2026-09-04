<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $timestamp = now();

        DB::table('profile_types')->insert([
            ['name' => 'Individual', 'slug' => 'individual', 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Business', 'slug' => 'business', 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Student', 'slug' => 'student', 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Courier', 'slug' => 'courier', 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Fleet Operator', 'slug' => 'fleet-operator', 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);

        DB::table('v_ride_types')->insert([
            ['name' => 'Motorcycle', 'slug' => 'motorcycle', 'description' => 'Two-wheeled vehicle ride service.', 'requires_drivers_license' => true, 'requires_vehicle_registration' => true, 'requires_insurance' => true, 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Tricycle', 'slug' => 'tricycle', 'description' => 'Three-wheeled vehicle ride service.', 'requires_drivers_license' => true, 'requires_vehicle_registration' => true, 'requires_insurance' => true, 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Compact Car', 'slug' => 'compact-car', 'description' => 'Small passenger car ride service.', 'requires_drivers_license' => true, 'requires_vehicle_registration' => true, 'requires_insurance' => true, 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'SUV', 'slug' => 'suv', 'description' => 'Sport utility vehicle ride service.', 'requires_drivers_license' => true, 'requires_vehicle_registration' => true, 'requires_insurance' => true, 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Pickup Truck', 'slug' => 'pickup-truck', 'description' => 'Light pickup vehicle ride service.', 'requires_drivers_license' => true, 'requires_vehicle_registration' => true, 'requires_insurance' => true, 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);

        $users = User::factory(30)->create();

        DB::table('pudos')->insert([
            ['user_id' => $users[0]->id, 'code' => 'PUDO-001', 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['user_id' => $users[1]->id, 'code' => 'PUDO-002', 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['user_id' => $users[2]->id, 'code' => 'PUDO-003', 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['user_id' => $users[3]->id, 'code' => 'PUDO-004', 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['user_id' => $users[4]->id, 'code' => 'PUDO-005', 'status' => 'active', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);
        $pudoIds = DB::table('pudos')->pluck('id', 'code');
        $rideTypeIds = DB::table('v_ride_types')->pluck('id', 'slug');

        $rideDefinitions = [
            ['type' => 'motorcycle', 'pudo' => 'PUDO-001', 'status' => 'pending'],
            ['type' => 'tricycle', 'pudo' => 'PUDO-002', 'status' => 'approved', 'approved_at' => $timestamp],
            ['type' => 'compact-car', 'pudo' => 'PUDO-003', 'status' => 'active', 'approved_at' => $timestamp],
            ['type' => 'suv', 'pudo' => 'PUDO-004', 'status' => 'suspended', 'suspended_at' => $timestamp, 'suspension_reason' => 'Insurance documents require renewal.'],
            ['type' => 'pickup-truck', 'pudo' => 'PUDO-005', 'status' => 'rejected'],
        ];

        foreach ($rideDefinitions as $rideDefinition) {
            DB::table('v_rides')->insert([
                'v_ride_type_id' => $rideTypeIds[$rideDefinition['type']],
                'pudo_id' => $pudoIds[$rideDefinition['pudo']],
                'status' => $rideDefinition['status'],
                'approved_at' => $rideDefinition['approved_at'] ?? null,
                'suspended_at' => $rideDefinition['suspended_at'] ?? null,
                'suspension_reason' => $rideDefinition['suspension_reason'] ?? null,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }

        $rideIds = DB::table('v_rides')->orderBy('id')->pluck('id');

        DB::table('v_ride_kycs')->insert([
            ['v_ride_id' => $rideIds[0], 'id_type' => 'DL', 'code' => 'DL-10001', 'status' => 'pending', 'lookup_provider' => 'internal', 'selfie' => 'pending', 'make' => 'Honda', 'model' => 'CB125F', 'year' => 2022, 'color' => 'Red', 'registration_number' => 'REG-VR-0001', 'plate_number' => 'KJA-101AA', 'vin' => 'VINVR00000000001', 'weight_capacity' => 120, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['v_ride_id' => $rideIds[1], 'id_type' => 'NIN', 'code' => 'NIN-10002', 'status' => 'processing', 'lookup_provider' => 'internal', 'selfie' => 'approved', 'make' => 'Bajaj', 'model' => 'RE', 'year' => 2021, 'color' => 'Blue', 'registration_number' => 'REG-VR-0002', 'plate_number' => 'KJA-102AA', 'vin' => 'VINVR00000000002', 'weight_capacity' => 300, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['v_ride_id' => $rideIds[2], 'id_type' => 'PASSPORT', 'code' => 'P-10003', 'status' => 'verified', 'lookup_provider' => 'internal', 'selfie' => 'approved', 'make' => 'Toyota', 'model' => 'Corolla', 'year' => 2020, 'color' => 'Silver', 'registration_number' => 'REG-VR-0003', 'plate_number' => 'KJA-103AA', 'vin' => 'VINVR00000000003', 'weight_capacity' => 450, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['v_ride_id' => $rideIds[3], 'id_type' => 'BVN', 'code' => 'BVN-10004', 'status' => 'rejected', 'lookup_provider' => 'internal', 'selfie' => 'rejected', 'make' => 'Ford', 'model' => 'Explorer', 'year' => 2019, 'color' => 'Black', 'registration_number' => 'REG-VR-0004', 'plate_number' => 'KJA-104AA', 'vin' => 'VINVR00000000004', 'weight_capacity' => 650, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['v_ride_id' => $rideIds[4], 'id_type' => 'DL', 'code' => 'DL-10005', 'status' => 'verified', 'lookup_provider' => 'internal', 'selfie' => 'approved', 'make' => 'Isuzu', 'model' => 'D-Max', 'year' => 2023, 'color' => 'White', 'registration_number' => 'REG-VR-0005', 'plate_number' => 'KJA-105AA', 'vin' => 'VINVR00000000005', 'weight_capacity' => 900, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);
    }
}
