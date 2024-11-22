#!/bin/bash

URL=$1
TOKEN=$2

curl $URL/api/addresses \
    -X POST \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --header "Authorization: Bearer $TOKEN" \
    --data '{"id": "1000", "street": "Hansaallee", "house_number": "154", "city": "Frankfurt am Main", "zip_code": "60320"}'

curl $URL/api/addresses \
    -X POST \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --header "Authorization: Bearer $TOKEN" \
    --data '{"id": "1001", "street": "Friedrich-Ebert-Anlage", "house_number": "49", "city": "Frankfurt am Main", "zip_code": "60308"}'

curl $URL/api/addresses \
    -X POST \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --header "Authorization: Bearer $TOKEN" \
    --data '{"id": "1002", "street": "Wohnstraße", "house_number": "123a", "city": "Frankfurt am Main", "zip_code": "60308"}'

curl $URL/api/users \
    -X POST \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --header "Authorization: Bearer $TOKEN" \
    --data '{"id": "2000", "address_id": "1000", "name": "guido", "first_name": "Guido", "last_name": "Anders", "email": "g.anders@city-residence.de", "role": "LANDLORD"}'

curl $URL/api/users \
    -X POST \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --header "Authorization: Bearer $TOKEN" \
    --data '{"id": "2001", "address_id": "1001", "name": "brian", "first_name": "Brian", "last_name": "St. Hilaire", "email": "brian.st-hilaire@sanctus-tech.com", "role": "RENTER"}'

curl $URL/api/houses \
    -X POST \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --header "Authorization: Bearer $TOKEN" \
    --data '{"id": "3002", "address_id": "1002", "house_description": "schöner", "house_type": "Neubau", "number_of_stories": "5", "year_of_construction": "2000", "energy_source": "BIO_ENERGY", "has_elevator": "1"}'

curl $URL/api/apartments \
    -X POST \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --header "Authorization: Bearer $TOKEN" \
    --data '{"id": "4002", "house_id": "3002", "user_id": "2000", "number_of_rooms": "4", "number_of_bedrooms": "2", "size_sq_m": "99", "is_furnished": "1", "pets_ok": "0"}'

curl $URL/api/offers \
    -X POST \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --header "Authorization: Bearer $TOKEN" \
    --data '{"id": "5002", "apartment_id": "4002", "user_id": "2000", "status": "FREE", "rent": "1000", "number_of_persons": "2", "heating_cost_included": "0", "heating_cost_amount": "50"}'

curl $URL/api/renters \
    -X POST \
    --header "Accept: application/json" \
    --header "Content-Type: application/json" \
    --header "Authorization: Bearer $TOKEN" \
    --data '{"id": "6001", "user_id": "2001", "status": "RESERVED", "max_rent": "1000", "min_number_of_rooms": "2", "must_be_furnished": "1"}'
