<?php 

class Documents
{
	use Controller;

	public function index()
	{
		if (!is_authenticated()) {
			set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
			redirect('');
		}

		$documentModel = new Document();
		$documentsData = $documentModel->findAll();

		$data['documents'] = [];
		$data['index'] = 1;

		if (!empty($documentsData)){
			foreach ($documentsData as $document) {
				$uploadDate = date('F j, Y', strtotime($document->created_at)); // Format the upload date as "January 2, 2023"
				$data['documents'][] = [
					'document_name' => $document->filename,
					'document_type' => $document->document_type,
					'upload_date' => $uploadDate,
					'document_url' => $document->file_path
				];
			}
		}

		echo $this->renderView('documents', true, $data);
	}
}