<?php

class EventsRepository
{
  private PDO $connection;
  public function __construct(
    private Database $database
  ) {
    $this->connection = $this->database->getConnection();
  }

  public function getEvents(): array
  {
    $stmt = $this->connection->prepare('SELECT * FROM events');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getEvent(int $id): array
  {
    $stmt = $this->connection->prepare('SELECT * FROM events WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function createEvent(array $data): array
  {
    $stmt = $this->connection->prepare('INSERT INTO events (name, description, attendees, date_time, address, country, city, country_code, lon, lat, timezone_name) VALUES (:name, :description, :attendees, :date_time, :address, :country, :city, :country_code, :lon, :lat, :timezone_name)');
    $stmt->execute(['name' => $data['name'], 'description' => $data['description'] ?? null, 'attendees' => $data['attendees'] ?? null, 'date_time' => $data['date_time'], 'address' => $data['address'] ?? null, 'country' => $data['country'], 'city' => $data['city'], 'country_code' => $data['country_code'], 'lon' => $data['lon'], 'lat' => $data['lat'], 'timezone_name' => $data['timezone_name']]);
    return $this->getEvent((int)$this->connection->lastInsertId());
  }

  public function updateEvent(int $id, array $data): array
  {
    // remove category from data as its being handled separately.
    unset($data['categories']);

    $fields = '';
    foreach ($data as $key => $value) {
        $fields .= $key . ' = :' . $key . ', ';
    }
    $fields = rtrim($fields, ', ');

    $stmt = $this->connection->prepare('UPDATE events SET ' . $fields . ' WHERE id = :id');
    $data['id'] = $id;
    $stmt->execute($data);
    return $this->getEvent($id);
  }

  public function deleteEvent(int $id): array
  {
    $event = $this->getEvent($id);
    $stmt = $this->connection->prepare('DELETE FROM events WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $event;
  }

  public function getEventCategories(int $id): array
  {
    $stmt = $this->connection->prepare('SELECT c.id, c.name FROM categories c JOIN events_categories ec ON c.id = ec.category_id WHERE ec.event_id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addEventCategory(int $event_id, int $category_id): array
  {
    $stmt = $this->connection->prepare('INSERT INTO events_categories (event_id, category_id) VALUES (:event_id, :category_id)');
    $stmt->execute(['event_id' => $event_id, 'category_id' => $category_id]);
    return $this->getEventCategories($event_id);
  }

  public function addEventCategories(int $event_id, array $categories): array
  {
    $stmt = $this->connection->prepare('INSERT INTO events_categories (event_id, category_id) VALUES (:event_id, :category_id)');
    foreach ($categories as $category_id) {
      $stmt->execute(['event_id' => $event_id, 'category_id' => $category_id]);
    }
    return $this->getEventCategories($event_id);
  }

  public function updateEventCategories(int $event_id, array $categories): array
  {
    $stmt = $this->connection->prepare('DELETE FROM events_categories WHERE event_id = :event_id');
    $stmt->execute(['event_id' => $event_id]);
    $stmt = $this->connection->prepare('INSERT INTO events_categories (event_id, category_id) VALUES (:event_id, :category_id)');
    foreach ($categories as $category_id) {
      $stmt->execute(['event_id' => $event_id, 'category_id' => $category_id]);
    }
    return $this->getEventCategories($event_id);
  }

  public function removeEventCategory(int $event_id, int $category_id): array
  {
    $stmt = $this->connection->prepare('DELETE FROM events_categories WHERE event_id = :event_id AND category_id = :category_id');
    $stmt->execute(['event_id' => $event_id, 'category_id' => $category_id]);
    return $this->getEventCategories($event_id);
  }
}
