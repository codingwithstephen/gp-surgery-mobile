# GP Surgery Mobile API Documentation

## Overview

The GP Surgery Mobile API provides RESTful endpoints for managing patients, doctors, appointments, and medical records. All API endpoints require authentication using Laravel Sanctum.

## Base URL

```
http://localhost:8000/api
```

## Authentication

### Register a new user

```http
POST /register
Content-Type: application/json

{
  "name": "User Name",
  "email": "user@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

### Login

```http
POST /login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "password"
}
```

Response:
```json
{
  "user": {
    "id": 1,
    "name": "User Name",
    "email": "user@example.com"
  }
}
```

### Logout

```http
POST /logout
Authorization: Bearer {token}
```

## API Endpoints

All endpoints below require authentication. Include the authentication token in the `Authorization` header:

```
Authorization: Bearer {your_token}
```

### Patients

#### List all patients

```http
GET /api/patients
```

Response:
```json
{
  "data": [
    {
      "id": 1,
      "first_name": "John",
      "last_name": "Doe",
      "email": "john.doe@example.com",
      "phone": "07700 900123",
      "date_of_birth": "1985-05-15",
      "gender": "male",
      "address": "123 High Street, London",
      "nhs_number": "4505577104",
      "medical_history": "Hypertension",
      "allergies": "Penicillin",
      "created_at": "2025-11-13T22:00:00.000000Z",
      "updated_at": "2025-11-13T22:00:00.000000Z"
    }
  ],
  "links": {...},
  "meta": {...}
}
```

#### Get a specific patient

```http
GET /api/patients/{id}
```

#### Create a new patient

```http
POST /api/patients
Content-Type: application/json

{
  "first_name": "John",
  "last_name": "Doe",
  "email": "john.doe@example.com",
  "phone": "07700 900123",
  "date_of_birth": "1985-05-15",
  "gender": "male",
  "address": "123 High Street, London",
  "nhs_number": "4505577104",
  "medical_history": "Hypertension",
  "allergies": "Penicillin"
}
```

#### Update a patient

```http
PUT /api/patients/{id}
Content-Type: application/json

{
  "first_name": "John",
  "phone": "07700 900124"
}
```

#### Delete a patient

```http
DELETE /api/patients/{id}
```

### Doctors

#### List all doctors

```http
GET /api/doctors
```

Response:
```json
{
  "data": [
    {
      "id": 1,
      "first_name": "Sarah",
      "last_name": "Johnson",
      "email": "sarah.johnson@gpsurgery.com",
      "phone": "020 1234 5678",
      "specialization": "General Practice",
      "license_number": "GMC12345",
      "qualifications": "MBBS, MRCGP",
      "created_at": "2025-11-13T22:00:00.000000Z",
      "updated_at": "2025-11-13T22:00:00.000000Z"
    }
  ]
}
```

#### Get a specific doctor

```http
GET /api/doctors/{id}
```

#### Create a new doctor

```http
POST /api/doctors
Content-Type: application/json

{
  "first_name": "Sarah",
  "last_name": "Johnson",
  "email": "sarah.johnson@gpsurgery.com",
  "phone": "020 1234 5678",
  "specialization": "General Practice",
  "license_number": "GMC12345",
  "qualifications": "MBBS, MRCGP"
}
```

#### Update a doctor

```http
PUT /api/doctors/{id}
Content-Type: application/json

{
  "phone": "020 1234 5679"
}
```

#### Delete a doctor

```http
DELETE /api/doctors/{id}
```

### Appointments

#### List all appointments

```http
GET /api/appointments
```

Response:
```json
{
  "data": [
    {
      "id": 1,
      "patient_id": 1,
      "doctor_id": 1,
      "appointment_date": "2025-11-15T10:00:00.000000Z",
      "duration_minutes": 30,
      "status": "scheduled",
      "reason": "Routine checkup",
      "notes": null,
      "patient": {...},
      "doctor": {...},
      "created_at": "2025-11-13T22:00:00.000000Z",
      "updated_at": "2025-11-13T22:00:00.000000Z"
    }
  ]
}
```

#### Get a specific appointment

```http
GET /api/appointments/{id}
```

#### Create a new appointment

```http
POST /api/appointments
Content-Type: application/json

{
  "patient_id": 1,
  "doctor_id": 1,
  "appointment_date": "2025-11-15T10:00:00",
  "duration_minutes": 30,
  "status": "scheduled",
  "reason": "Routine checkup",
  "notes": "Patient requested morning appointment"
}
```

#### Update an appointment

```http
PUT /api/appointments/{id}
Content-Type: application/json

{
  "status": "confirmed",
  "notes": "Confirmed by reception"
}
```

#### Delete an appointment

```http
DELETE /api/appointments/{id}
```

### Medical Records

#### List all medical records

```http
GET /api/medical-records
```

Response:
```json
{
  "data": [
    {
      "id": 1,
      "patient_id": 1,
      "doctor_id": 1,
      "appointment_id": 1,
      "visit_date": "2025-11-13",
      "diagnosis": "Upper respiratory infection",
      "symptoms": "Cough, fever, sore throat",
      "treatment": "Rest and fluids",
      "prescription": "Amoxicillin 500mg, 3 times daily for 7 days",
      "notes": "Follow up in 1 week if symptoms persist",
      "patient": {...},
      "doctor": {...},
      "appointment": {...},
      "created_at": "2025-11-13T22:00:00.000000Z",
      "updated_at": "2025-11-13T22:00:00.000000Z"
    }
  ]
}
```

#### Get a specific medical record

```http
GET /api/medical-records/{id}
```

#### Create a new medical record

```http
POST /api/medical-records
Content-Type: application/json

{
  "patient_id": 1,
  "doctor_id": 1,
  "appointment_id": 1,
  "visit_date": "2025-11-13",
  "diagnosis": "Upper respiratory infection",
  "symptoms": "Cough, fever, sore throat",
  "treatment": "Rest and fluids",
  "prescription": "Amoxicillin 500mg",
  "notes": "Follow up in 1 week"
}
```

#### Update a medical record

```http
PUT /api/medical-records/{id}
Content-Type: application/json

{
  "notes": "Patient improved, no follow-up needed"
}
```

#### Delete a medical record

```http
DELETE /api/medical-records/{id}
```

## Error Responses

### 401 Unauthorized

```json
{
  "message": "Unauthenticated."
}
```

### 422 Unprocessable Entity (Validation Error)

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": [
      "The email has already been taken."
    ]
  }
}
```

### 404 Not Found

```json
{
  "message": "Resource not found."
}
```

## Status Codes

- `200 OK` - Request successful
- `201 Created` - Resource created successfully
- `204 No Content` - Resource deleted successfully
- `401 Unauthorized` - Authentication required
- `404 Not Found` - Resource not found
- `422 Unprocessable Entity` - Validation error

## Pagination

List endpoints return paginated results with the following structure:

```json
{
  "data": [...],
  "links": {
    "first": "http://localhost:8000/api/patients?page=1",
    "last": "http://localhost:8000/api/patients?page=3",
    "prev": null,
    "next": "http://localhost:8000/api/patients?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 3,
    "per_page": 15,
    "to": 15,
    "total": 45
  }
}
```

## Testing the API

You can test the API using tools like:

- **Postman**: Import the endpoints and test them
- **cURL**: Use command-line requests
- **HTTPie**: User-friendly command-line HTTP client

Example using cURL:

```bash
# Register a user
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Test User","email":"test@example.com","password":"password","password_confirmation":"password"}'

# Login
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password"}'

# Get patients (with token)
curl -X GET http://localhost:8000/api/patients \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```
