<?php

class EventsController
{
  public function __construct(
    private EventsModel $model
  ) {
  }

  public function processRequest(string $method, ?string $id): void
  {
    switch ($method) {
      case 'GET':
        if ($id) {
          $this->getEvent((int)$id);
        } else {
          $this->getEvents();
        }
        break;
      case 'POST':
        $event = $this->createEvent();


        break;
      case 'PUT':
        $this->updateEvent((int)$id);
        break;
      case 'DELETE':
        $this->deleteEvent((int)$id);
        break;
      default:
        http_response_code(404);
        echo json_encode(['error' => 'Method not found']);
    }
  }

  public function getEvents(): void
  {
    $events = $this->model->getEvents();

    // add categories to each event
    foreach ($events as $key => $event) {
      $categories = $this->model->getEventCategories($event['id']);
      $events[$key]['categories'] = $categories;
    }
    echo json_encode($events);
  }

  public function getEvent(int $id): void
  {
    $event = $this->model->getEvent($id);

    if (!$event) {
      http_response_code(404);
      echo json_encode(['error' => 'Event not found']);
      return;
    }

    // add categories to event
    $categories = $this->model->getEventCategories($event['id']);
    $event['categories'] = $categories;
    echo json_encode($event);
  }

  public function createEvent(): void
  {
    $data = (array)json_decode(file_get_contents('php://input'), true);

    //validate data
    $errors = $this->validate($data);
    if (!empty($errors)) {
      http_response_code(400);
      echo json_encode(['errors' => $errors]);
      return;
    }

    $event = $this->model->createEvent($data);
    // add categories to event
    $categories = $this->addEventCategories($event['id']);
    $event['categories'] = $categories;

    echo json_encode($event);
  }

  public function updateEvent(int $id): void
  {
    $data = json_decode(file_get_contents('php://input'), true);

    //validate data
    $errors = $this->validate($data, false);
    if (!empty($errors)) {
      http_response_code(400);
      echo json_encode(['errors' => $errors]);
      return;
    }

    $event = $this->model->updateEvent($id, $data);
    // update categories for event
    $categories = $this->updateEventCategories((int)$id);
    $event['categories'] = $categories;

    echo json_encode($event);
  }

  public function deleteEvent(int $id): void
  {
    $event = $this->model->deleteEvent($id);
    echo json_encode(['data' => "Event id: $id deleted"]);
  }

  public function getEventCategories(int $id): void
  {
    $categories = $this->model->getEventCategories($id);
    echo json_encode($categories);
  }

  public function addEventCategory(int $event_id, int $category_id): void
  {
    $category = $this->model->addEventCategory($event_id, $category_id);
    echo json_encode($category);
  }

  private function addEventCategories(int $event_id): array|null
  {
    $data = (array)json_decode(file_get_contents('php://input'), true);

    if (!isset($data['categories']) || empty($data['categories'])) {
      new ErrorException('Categories are required', 400, 1, __FILE__, __LINE__);
      return null;
    }

    $categories = $this->model->addEventCategories($event_id, $data['categories']);
    return $categories;
  }

  private function updateEventCategories(int $event_id): array|null
  {
    $data = (array)json_decode(file_get_contents('php://input'), true);

    if (!isset($data['categories']) || empty($data['categories'])) {
      new ErrorException('Categories are required', 400, 1, __FILE__, __LINE__);
      return null;
    }
    $categories = $this->model->updateEventCategories($event_id, $data['categories']);
    return $categories;
  }

  public function removeEventCategory(int $event_id, int $category_id): void
  {
    $category = $this->model->removeEventCategory($event_id, $category_id);
    echo json_encode($category);
  }

  public function validate(array $data, bool $create = true): array
  {
    $errors = [];

    if ($create) {
      if (!isset($data['name']) || empty($data['name'])) {
        $errors['name'] = 'Name is required';
      }

      if (!isset($data['date_time']) || empty($data['date_time'])) {
        $errors['date_time'] = 'Date time is required';
      }

      if (!isset($data['country']) || empty($data['country'])) {
        $errors['country'] = 'Country is required';
      }
      if (!isset($data['city']) || empty($data['city'])) {
        $errors['city'] = 'City is required';
      }
      if (!isset($data['country_code']) || empty($data['country_code'])) {
        $errors['country_code'] = 'Country code is required';
      }
      if (!isset($data['lon']) || empty($data['lon'])) {
        $errors['lon'] = 'Longitude is required';
      }
      if (!isset($data['lat']) || empty($data['lat'])) {
        $errors['lat'] = 'Latitude is required';
      }
      if (!isset($data['timezone_name']) || empty($data['timezone_name'])) {
        $errors['timezone_name'] = 'Timezone name is required';
      }
      if (!isset($data['categories']) || empty($data['categories'])) {
        $errors['categories'] = 'Categories are required';
      }
    }
    return $errors;
  }
}
