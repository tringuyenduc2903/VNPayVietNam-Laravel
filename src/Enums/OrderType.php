<?php

declare(strict_types=1);

namespace BeetechAsia\VNPay\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static FOOD_CONSUMPTION()
 * @method static static SNACKS_BEVERAGES()
 * @method static static DRY_FOOD()
 * @method static static MILK_CREAM_DAIRY()
 * @method static static CLEANING_PRODUCTS()
 * @method static static MOBILE_TABLET()
 * @method static static MOBILE_PHONE()
 * @method static static TABLET()
 * @method static static SMART_WATCH()
 * @method static static ACCESSORIES()
 * @method static static SIM_CARD()
 * @method static static HOUSEHOLD_APPLIANCES()
 * @method static static KITCHEN_APPLIANCES()
 * @method static static HOME_APPLIANCES()
 * @method static static REFRIGERATION_LARGE_APPLIANCES()
 * @method static static COMPUTER_OFFICE_EQUIPMENT()
 * @method static static LAPTOP()
 * @method static static DESKTOP()
 * @method static static MONITOR()
 * @method static static NETWORK_EQUIPMENT()
 * @method static static SOFTWARE()
 * @method static static COMPUTER_ACCESSORIES()
 * @method static static PRINTER()
 * @method static static OTHER_OFFICE_EQUIPMENT()
 * @method static static ELECTRONICS_AUDIO()
 * @method static static TELEVISION()
 * @method static static SPEAKER()
 * @method static static AUDIO_SYSTEM()
 * @method static static TECH_TOYS()
 * @method static static DIGITAL_DEVICES()
 * @method static static BOOKS_MAGAZINES()
 * @method static static STATIONERY()
 * @method static static GIFTS()
 * @method static static MUSICAL_INSTRUMENTS()
 * @method static static SPORTS_OUTDOOR()
 * @method static static SPORTS_CLOTHING()
 * @method static static SPORTS_ACCESSORIES()
 * @method static static YOGA_FITNESS_EQUIPMENT()
 * @method static static OUTDOOR_EQUIPMENT()
 * @method static static HOTEL_TOURISM()
 * @method static static DOMESTIC_TOURISM()
 * @method static static INTERNATIONAL_TOURISM()
 * @method static static HOTEL_BOOKING()
 * @method static static CULINARY()
 * @method static static ENTERTAINMENT_TRAINING()
 * @method static static MOVIE_TICKETS()
 * @method static static ONLINE_COURSES()
 * @method static static OTHER_ENTERTAINMENT()
 * @method static static ONLINE_COURSE_MEMBERSHIP()
 * @method static static FASHION()
 * @method static static WOMENS_FASHION()
 * @method static static WOMENS_ACCESSORIES()
 * @method static static MENS_FASHION()
 * @method static static KIDS_FASHION()
 * @method static static HEALTH_BEAUTY()
 * @method static static SUNSCREEN()
 * @method static static FACIAL_CARE()
 * @method static static MAKEUP()
 * @method static static PERSONAL_CARE()
 * @method static static MOTHER_BABY()
 * @method static static BABY_MILK_FORMULA()
 * @method static static BABY_HYGIENE()
 * @method static static BABY_TOYS_SUPPLIES()
 * @method static static BABY_FEEDING_SUPPLIES()
 * @method static static KITCHEN_UTENSILS()
 * @method static static FURNITURE()
 * @method static static VEHICLES()
 * @method static static MOTORBIKE()
 * @method static static MOTORBIKE_ACCESSORIES()
 * @method static static CAR_ACCESSORIES()
 * @method static static ELECTRIC_BICYCLE()
 * @method static static BILL_PAYMENT()
 * @method static static ELECTRICITY_BILL()
 * @method static static WATER_BILL()
 * @method static static POSTPAID_PHONE_BILL()
 * @method static static ADSL_BILL()
 * @method static static CABLE_TV_BILL()
 * @method static static SERVICE_BILL()
 * @method static static FLIGHT_TICKETS()
 * @method static static PREPAID_CARDS()
 * @method static static PHONE_CARDS()
 * @method static static GAME_CARDS()
 * @method static static PHARMACY_MEDICAL_SERVICES()
 * @method static static MEDICAL_APPOINTMENTS()
 */
final class OrderType extends Enum implements LocalizedEnum
{
    const int FOOD_CONSUMPTION = 100000;

    const int SNACKS_BEVERAGES = 100001;

    const int DRY_FOOD = 100003;

    const int MILK_CREAM_DAIRY = 100004;

    const int CLEANING_PRODUCTS = 100005;

    const int MOBILE_TABLET = 110000;

    const int MOBILE_PHONE = 110001;

    const int TABLET = 110002;

    const int SMART_WATCH = 110003;

    const int ACCESSORIES = 110004;

    const int SIM_CARD = 110005;

    const int HOUSEHOLD_APPLIANCES = 120000;

    const int KITCHEN_APPLIANCES = 120001;

    const int HOME_APPLIANCES = 120002;

    const int REFRIGERATION_LARGE_APPLIANCES = 120003;

    const int COMPUTER_OFFICE_EQUIPMENT = 130000;

    const int LAPTOP = 130001;

    const int DESKTOP = 130002;

    const int MONITOR = 130003;

    const int NETWORK_EQUIPMENT = 130004;

    const int SOFTWARE = 130005;

    const int COMPUTER_ACCESSORIES = 130006;

    const int PRINTER = 130007;

    const int OTHER_OFFICE_EQUIPMENT = 130008;

    const int ELECTRONICS_AUDIO = 140000;

    const int TELEVISION = 140001;

    const int SPEAKER = 140002;

    const int AUDIO_SYSTEM = 140003;

    const int TECH_TOYS = 140004;

    const int DIGITAL_DEVICES = 140005;

    const int BOOKS_MAGAZINES = 150000;

    const int STATIONERY = 150001;

    const int GIFTS = 150002;

    const int MUSICAL_INSTRUMENTS = 150003;

    const int SPORTS_OUTDOOR = 160000;

    const int SPORTS_CLOTHING = 160001;

    const int SPORTS_ACCESSORIES = 160002;

    const int YOGA_FITNESS_EQUIPMENT = 160003;

    const int OUTDOOR_EQUIPMENT = 160004;

    const int HOTEL_TOURISM = 170000;

    const int DOMESTIC_TOURISM = 170001;

    const int INTERNATIONAL_TOURISM = 170002;

    const int HOTEL_BOOKING = 170003;

    const int CULINARY = 180000;

    const int ENTERTAINMENT_TRAINING = 190000;

    const int MOVIE_TICKETS = 190001;

    const int ONLINE_COURSES = 190002;

    const int OTHER_ENTERTAINMENT = 190003;

    const int ONLINE_COURSE_MEMBERSHIP = 190004;

    const int FASHION = 200000;

    const int WOMENS_FASHION = 200001;

    const int WOMENS_ACCESSORIES = 200002;

    const int MENS_FASHION = 200003;

    const int KIDS_FASHION = 200004;

    const int HEALTH_BEAUTY = 210000;

    const int SUNSCREEN = 210001;

    const int FACIAL_CARE = 210002;

    const int MAKEUP = 210003;

    const int PERSONAL_CARE = 210004;

    const int MOTHER_BABY = 220000;

    const int BABY_MILK_FORMULA = 220001;

    const int BABY_HYGIENE = 220002;

    const int BABY_TOYS_SUPPLIES = 220003;

    const int BABY_FEEDING_SUPPLIES = 220004;

    const int KITCHEN_UTENSILS = 230000;

    const int FURNITURE = 230001;

    const int VEHICLES = 240000;

    const int MOTORBIKE = 240001;

    const int MOTORBIKE_ACCESSORIES = 240002;

    const int CAR_ACCESSORIES = 240003;

    const int ELECTRIC_BICYCLE = 240004;

    const int BILL_PAYMENT = 250000;

    const int ELECTRICITY_BILL = 250001;

    const int WATER_BILL = 250002;

    const int POSTPAID_PHONE_BILL = 250003;

    const int ADSL_BILL = 250004;

    const int CABLE_TV_BILL = 250005;

    const int SERVICE_BILL = 250006;

    const int FLIGHT_TICKETS = 250007;

    const int PREPAID_CARDS = 260000;

    const int PHONE_CARDS = 260001;

    const int GAME_CARDS = 260002;

    const int PHARMACY_MEDICAL_SERVICES = 270000;

    const int MEDICAL_APPOINTMENTS = 270001;
}
