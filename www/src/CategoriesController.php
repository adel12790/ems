<?php
require_once 'shared/functions.php';

class CategoriesController {
    public function __construct(
        private CategoriesModel $model
    ) {
    }

    public function processRequest(string $method, ?string $id): void
    {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $this->getCategory(h($id));
                } else {
                    $this->getCategories();
                }
                break;
            case 'POST':
                $this->createCategory();
                break;
            case 'PUT':
                $this->updateCategory(h($id));
                break;
            case 'DELETE':
                $this->deleteCategory(h($id));
                break;
            default:
                http_response_code(404);
                echo json_encode(['error' => 'Method not found']);
        }
    }

    public function getCategories(): void
    {
        $categories = $this->model->getCategories();
        echo json_encode($categories);
    }

    public function getCategory(int $id): void
    {
        $category = $this->model->getCategory($id);

        if (!$category) {
            http_response_code(404);
            echo json_encode(['error' => 'Category not found']);
            return;
        }
        echo json_encode($category);
    }

    public function createCategory(): void
    {
        $data = (array)json_decode(file_get_contents('php://input'), true);

        //validate data
        $errors = $this->validate($data);
        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $category = $this->model->createCategory($data);
        echo json_encode($category);
    }

    public function updateCategory(int $id): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        //validate data
        $errors = $this->validate($data, false);
        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $category = $this->model->updateCategory($id, $data);
        echo json_encode($category);
    }

    public function deleteCategory(int $id): void
    {
        $category = $this->model->deleteCategory($id);
        echo json_encode($category);
    }

    public function validate(array $data, bool $is_new = true): array
    {
        $errors = [];

        if ($is_new && empty($data['name'])) {
            $errors['name'] = 'Name is required';
        }

        return $errors;
    }
}
