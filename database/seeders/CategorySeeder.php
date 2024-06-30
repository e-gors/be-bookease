<?php

namespace Database\Seeders;

use App\Models\ChildCategory;
use App\Models\ParentCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Event Venues',
                'description' => 'Locations or spaces rented for hosting events such as weddings, parties, conferences, and meetings.',
                'children' => [
                    ['name' => 'Wedding Venues', 'description' => 'Venues specifically tailored for weddings.'],
                    ['name' => 'Conference Centers', 'description' => 'Venues equipped for conferences and meetings.'],
                ]
            ],
            [
                'name' => 'Hair and Beauty Services',
                'description' => 'Services provided by professionals like hairstylists and makeup artists for haircuts, styling, coloring, makeup application, and beauty treatments.',
                'children' => [
                    ['name' => 'Haircuts', 'description' => 'Professional hair cutting services.'],
                    ['name' => 'Makeup Application', 'description' => 'Makeup services for special occasions.'],
                ]
            ],
            [
                'name' => 'Home Services',
                'description' => 'Services for maintaining and improving residential properties, including plumbing, electrical work, cleaning, pest control, and more.',
                'children' => [
                    ['name' => 'Plumbing', 'description' => 'Installation and repair of plumbing systems.'],
                    ['name' => 'Electrical Services', 'description' => 'Electrical installation and maintenance.'],
                ]
            ],
            [
                'name' => 'Hotel Accommodations',
                'description' => 'Lodging facilities offering temporary accommodations for travelers, tourists, and visitors.',
                'children' => []
            ],
            [
                'name' => 'Legal Consultations',
                'description' => 'Services provided by lawyers and notary publics for legal advice, document verification, and legal representation.',
                'children' => []
            ],
            [
                'name' => 'Medical Appointments',
                'description' => 'Scheduled visits to healthcare professionals such as doctors, dentists, and specialists for medical examinations and treatments.',
                'children' => []
            ],
            [
                'name' => 'Pet Services',
                'description' => 'Services for pets, including veterinary care, grooming, pet sitting, and other pet-related needs.',
                'children' => [
                    ['name' => 'Veterinary Care', 'description' => 'Medical care for pets provided by veterinarians.'],
                    ['name' => 'Pet Grooming', 'description' => 'Grooming services for pets.'],
                ]
            ],
            [
                'name' => 'Photography Sessions',
                'description' => 'Services provided by photographers and videographers for professional photo shoots, events, and video production.',
                'children' => []
            ],
            [
                'name' => 'Restaurant Reservations',
                'description' => 'Bookings made to secure tables and dining experiences at restaurants for meals and special occasions.',
                'children' => []
            ],
            [
                'name' => 'Spa and Wellness Treatments',
                'description' => 'Services for relaxation and health improvement, such as massages, facials, acupuncture, and other wellness therapies.',
                'children' => [
                    ['name' => 'Massage Therapy', 'description' => 'Therapeutic massage sessions.'],
                    ['name' => 'Facials', 'description' => 'Skin care treatments including facials.'],
                ]
            ],
            [
                'name' => 'Travel Services',
                'description' => 'Services provided by travel agents and tour guides, including booking flights, accommodations, tours, and travel packages.',
                'children' => [
                    ['name' => 'Flight Bookings', 'description' => 'Booking flights for travelers.'],
                    ['name' => 'Tour Packages', 'description' => 'Organized travel tours and packages.'],
                ]
            ],
            [
                'name' => 'Tutoring Sessions',
                'description' => 'Educational services offered by tutors and instructors for academic subjects, music lessons, language learning, and other educational needs.',
                'children' => [
                    ['name' => 'Academic Tutoring', 'description' => 'Tutoring for academic subjects.'],
                    ['name' => 'Music Lessons', 'description' => 'Music instruction and tutoring.'],
                ]
            ],
        ];

        foreach ($categories as $categoryData) {
            $parentCategory = ParentCategory::create([
                'name' => $categoryData['name'],
                'description' => $categoryData['description'],
            ]);

            foreach ($categoryData['children'] as $childData) {
                ChildCategory::create([
                    'parent_category_id' => $parentCategory->id,
                    'name' => $childData['name'],
                    'description' => $childData['description'],
                ]);
            }
        }
    }
}
