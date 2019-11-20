<?php

namespace Tests\Feature\Api;

use App\Contact;
use App\Facades\UUID;
use Tests\TestCase;
use Tests\Feature\UserToken;

class ContactsTest extends TestCase
{
    use UserToken;

    public function testCreateSuccess()
    {
        $contact = factory('App\Contact')->make();
        $headers = [
            'Authorization' => "Bearer " . $this->getToken()
        ];
        $response = $this->json('POST', '/api/contacts', $contact->toArray(), $headers);
        $response->assertStatus(201);
        $response->assertJsonStructure(['id']);
        $this->assertDatabaseHas('ref_contacts', [
            'name' => $contact->getName(),
            'phone' => $contact->getPhone(),
            'email' => $contact->getEmail(),
        ]);

        $id = $response->getData(true)['id'];

        $contact->id = $id;

        return $contact;

    }

    public function testShow()
    {
        $response = $this->json('GET', '/api/contacts', [], $this->getHeaders());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'phone', 'email', 'comment'],
        ]);
    }

    /**
     * @depends testCreateSuccess
     */
    public function testUpdateSuccess($contact)
    {
        $headers = [
            'Authorization' => "Bearer " . $this->getToken()
        ];

        $contact->name = $contact->name . ' modified';

        $response = $this->json('PUT', '/api/contacts/' . $contact->id, $contact->toArray(),
            $headers);

        $response->assertStatus(200);

        $this->assertDatabaseHas('ref_contacts', [
            'name' => $contact->getName(),
            'phone' => $contact->getPhone(),
            'email' => $contact->getEmail(),
        ]);

        return $contact;
    }

    /**
     * @depends testUpdateSuccess
     */
    public function testDeleteSuccess($contact)
    {
        $headers = [
            'Authorization' => "Bearer " . $this->getToken()
        ];

        $response = $this->json('DELETE', '/api/contacts/' . $contact->id, $contact->toArray(),
            $headers);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('ref_contacts', [
            'name' => $contact->getName(),
            'phone' => $contact->getPhone(),
            'email' => $contact->getEmail(),
        ]);
    }

    public function testUpdateError()
    {
        $headers = [
            'Authorization' => "Bearer " . $this->getToken()
        ];

        $contact = factory(Contact::class)->make();
        $contact->id = UUID::gen();

        $response = $this->json('PUT', '/api/contacts/' . $contact->id, $contact->toArray(),
            $headers);
        $response->assertStatus(404);
    }

    public function testDeleteError()
    {
        $headers = [
            'Authorization' => "Bearer " . $this->getToken()
        ];

        $contact = factory(Contact::class)->make();
        $contact->id = UUID::gen();

        $response = $this->json('DELETE', '/api/contacts/' . $contact->id, $contact->toArray(),
            $headers);
        $response->assertStatus(500);
    }


}
