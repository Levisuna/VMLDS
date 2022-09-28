<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use Illuminate\Http\Request;

class PageController extends _CrudController
{
    protected $passingDataHome;
    protected $passingDataAbout;

    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'key' => [
                'edit' => 0,
            ],
            'title' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'list' => 0
            ],
            'content' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
                'list' => 0
            ],
            'image' => [
                'type' => 'image',
                'list' => 0
            ],
            'created_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        $this->passingDataHome = generatePassingData([
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'key' => [
                'edit' => 0,
            ],
            'title' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'content' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
            ],
            'image' => [
                'path' => '/img',
                'type' => 'image'
            ],
            'contact_button' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'created_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ]);

        $this->passingDataAbout = generatePassingData([
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'key' => [
                'edit' => 0,
            ],
            'title' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'content' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
            ],
            'image' => [
                'path' => '/img',
                'type' => 'image'
            ],
            'title_2' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'lang' => 'general.our_vision'
            ],
            'content_2' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
                'lang' => 'general.our_vision_content'
            ],
            'title_3' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'lang' => 'general.our_mission'
            ],
            'content_3' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
                'lang' => 'general.our_mission_content'
            ],
            'created_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ]);

        parent::__construct(
            $request, 'general.page', 'page', 'page', 'page',
            $passingData
        );
    }

    public function edit($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data = $this->data;

        $getValue = json_decode($getData->value, true);
        $getData->title = $getValue['title'] ?? null;
        $getData->content = $getValue['content'] ?? null;
        $getData->image = $getValue['image'] ?? null;

        $passingData = $this->passingData;
        if($getData->key == 'homepage') {
            $passingData = $this->passingDataHome;
            $getData->contact_button = $getValue['contact_button'];
        }
        else if($getData->key == 'about') {
            $passingData = $this->passingDataAbout;
            $getData->title_2 = $getValue['title_2'] ?? null;
            $getData->content_2 = $getValue['content_2'] ?? null;
            $getData->title_3 = $getValue['title_3'] ?? null;
            $getData->content_3 = $getValue['content_3'] ?? null;
        }

        $data['viewType'] = 'edit';
        $data['formsTitle'] = __('general.title_edit', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    public function show($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data = $this->data;

        $getValue = json_decode($getData->value, true);
        $getData->title = $getValue['title'] ?? null;
        $getData->content = $getValue['content'] ?? null;
        $getData->image = $getValue['image'] ?? null;

        $passingData = $this->passingData;
        if($getData->key == 'homepage') {
            $passingData = $this->passingDataHome;
            $getData->contact_button = $getValue['contact_button'];
        }
        else if($getData->key == 'about') {
            $passingData = $this->passingDataAbout;
            $getData->title_2 = $getValue['title_2'] ?? null;
            $getData->content_2 = $getValue['content_2'] ?? null;
            $getData->title_3 = $getValue['title_3'] ?? null;
            $getData->content_3 = $getValue['content_3'] ?? null;
        }

        $data['viewType'] = 'show';
        $data['formsTitle'] = __('general.title_show', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    public function update($id)
    {
        $this->callPermission();

        $viewType = 'edit';

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $getValue = json_decode($getData->value, true);
        $getData->title = $getValue['title'] ?? null;
        $getData->content = $getValue['content'] ?? null;
        $getData->image = $getValue['image'] ?? null;

        $passingData = $this->passingData;
        if($getData->key == 'homepage') {
            $passingData = $this->passingDataHome;
            $getData->contact_button = $getValue['contact_button'] ?? null;
        }
        else if($getData->key == 'about') {
            $passingData = $this->passingDataAbout;
            $getData->title_2 = $getValue['title_2'] ?? null;
            $getData->content_2 = $getValue['content_2'] ?? null;
            $getData->title_3 = $getValue['title_3'] ?? null;
            $getData->content_3 = $getValue['content_3'] ?? null;
        }

        $getListCollectData = collectPassingData($passingData, $viewType);
        $validate = $this->setValidateData($getListCollectData, $viewType, $id);
        if (count($validate) > 0)
        {
            $data = $this->validate($this->request, $validate);
        }
        else {
            $data = [];
            foreach ($getListCollectData as $key => $val) {
                $data[$key] = $this->request->get($key);
            }
        }

        $data = $this->getCollectedData($getListCollectData, $viewType, $data, $getData);

        $value = [
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image'] ?? $getData->image,
        ];

        if($getData->key == 'homepage') {
            $value['contact_button'] = $data['contact_button'];
            unset($data['contact_button']);
        }
        else if($getData->key == 'about') {
            $value['title_2'] = $data['title_2'];
            $value['content_2'] = $data['content_2'];
            $value['title_3'] = $data['title_3'];
            $value['content_3'] = $data['content_3'];
            unset($data['title_2']);
            unset($data['content_2']);
            unset($data['title_3']);
            unset($data['content_3']);
        }

        $data['value'] = json_encode($value);
        unset($data['title']);
        unset($data['content']);
        unset($data['image']);

        $getData = $this->crud->update($data, $id);

        $id = $getData->id;

        if($this->request->ajax()){
            return response()->json(['result' => 1, 'message' => __('general.success_edit_', ['field' => $this->data['thisLabel']])]);
        }
        else {
            session()->flash('message', __('general.success_edit_', ['field' => $this->data['thisLabel']]));
            session()->flash('message_alert', 2);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.show', $id);
        }
    }

}
