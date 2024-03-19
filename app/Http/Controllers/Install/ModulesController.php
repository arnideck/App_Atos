<?php

namespace App\Http\Controllers\Install;

use \Module;
use App\Http\Controllers\Controller;
use App\Utils\ModuleUtil;
use Illuminate\Http\Request;
use ZipArchive;

class ModulesController extends Controller
{
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param ModuleUtil $moduleUtil
     * @return void
     */
    public function __construct(ModuleUtil $moduleUtil)
    {
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('manage_modules')) {
            abort(403, 'Unauthorized action.');
        }

        //Get list of all modules.
        $modules = Module::toCollection()->toArray();

        foreach ($modules as $module => $details) {
            $modules[$module]['is_installed'] = $this->moduleUtil->isModuleInstalled($details['name']) ? true : false;

            //Get version information.
            if ($modules[$module]['is_installed']) {
                $modules[$module]['version'] = $this->moduleUtil->getModuleVersionInfo($details['name']);
            }

            //Install Link.
            try {
                $modules[$module]['install_link'] = action('\Modules\\' . $details['name'] . '\Http\Controllers\InstallController@index');
            } catch (\Exception $e) {
                $modules[$module]['install_link'] = "#";
            }

            //Update Link.
            try {
                $modules[$module]['update_link'] = action('\Modules\\' . $details['name'] . '\Http\Controllers\InstallController@update');
            } catch (\Exception $e) {
                $modules[$module]['update_link'] = "#";
            }

            //Uninstall Link.
            try {
                $modules[$module]['uninstall_link'] = action('\Modules\\' . $details['name'] . '\Http\Controllers\InstallController@uninstall');
            } catch (\Exception $e) {
                $modules[$module]['uninstall_link'] = "#";
            }
        }

        $is_demo = (config('app.env') == 'demo');
        $mods = $this->__available_modules();

        return view('install.modules.index')
            ->with(compact('modules', 'is_demo', 'mods'));


        //Option to uninstall

        //Option to activate/deactivate

        //Upload module.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Activate/Deaactivate the specified module.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $module_name)
    {
        if (!auth()->user()->can('manage_modules')) {
            abort(403, 'Unauthorized action.');
        }
        
        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        try {
            $module = Module::find($module_name);

            //php artisan module:disable Blog
            if ($request->action_type == 'activate') {
                $module->enable();
            } elseif ($request->action_type == 'deactivate') {
                $module->disable();
            }

            $output = ['success' => true,
                            'msg' => __("lang_v1.success")
                        ];
        } catch (\Exception $e) {
            $output = ['success' => false,
                        'msg' => $e->getMessage()
                    ];
        }

        return redirect()->back()->with(['status' => $output]);
    }

    /**
     * Deletes the module.
     *
     * @param  string  $module_name
     * @return \Illuminate\Http\Response
     */
    public function destroy($module_name)
    {
        if (!auth()->user()->can('manage_modules')) {
            abort(403, 'Unauthorized action.');
        }

        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        try {
            $module = Module::find($module_name);
            $module->delete();

            $output = ['success' => true,
                            'msg' => __("lang_v1.success")
                        ];
        } catch (\Exception $e) {
            $output = ['success' => false,
                        'msg' => $e->getMessage()
                    ];
        }

        return redirect()->back()->with(['status' => $output]);
    }

    /**
     * Upload the module.
     *
     */
    public function uploadModule(Request $request)
    {
        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        try {

            //get zipped file
            $module = $request->file('module');

            //check if uploaded file is valid or not and and if not redirect back
            if ($module->getMimeType() != 'application/zip') {
                $output = ['success' => false,
                    'msg' => __('lang_v1.pls_upload_valid_zip_file')
                ];

                return redirect()->back()->with(['status' => $output]);
            }

            //check if 'Modules' folder exist or not, if not exist create
            $path = '../Modules';
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            //extract the zipped file in given path
            $zip = new ZipArchive();
            if ($zip->open($module) === true) {
                $zip->extractTo($path .'/');
                $zip->close();
            }

            $output = ['success' => true,
                    'msg' => __("lang_v1.success")
                ];
        } catch (Exception $e) {
            $output = ['success' => false,
                'msg' => __('messages.something_went_wrong')
            ];
        }

        return redirect()->back()->with(['status' => $output]);
    }

    private function __available_modules()
    {
        return 'a:8:{i:0;a:4:{s:1:"n";s:10:"Essentials";s:2:"dn";s:22:"Módulo Essencial e RH";s:1:"u";s:70:"https://lojadodesenvolvedor.com.br/product-tag/modulos-adicionais-php/";s:1:"d";s:58:"Recursos essenciais para todas as empresas em crescimento.";}i:1;a:4:{s:1:"n";s:10:"Superadmin";s:2:"dn";s:18:"Módulo Superadmin";s:1:"u";s:70:"https://lojadodesenvolvedor.com.br/product-tag/modulos-adicionais-php/";s:1:"d";s:76:"Transforme seu aplicativo WEB em SaaS e comece a ganhar vendendo assinaturas";}i:2;a:4:{s:1:"n";s:11:"Woocommerce";s:2:"dn";s:19:"Módulo Woocommerce";s:1:"u";s:70:"https://lojadodesenvolvedor.com.br/product-tag/modulos-adicionais-php/";s:1:"d";s:43:"Sincronize sua loja Woocommerce com Sistema";}i:3;a:4:{s:1:"n";s:13:"Manufacturing";s:2:"dn";s:23:"Módulo de Fabricação";s:1:"u";s:70:"https://lojadodesenvolvedor.com.br/product-tag/modulos-adicionais-php/";s:1:"d";s:81:"Fabricar produtos a partir de matérias-primas, organizar receitas e ingredientes";}i:4;a:4:{s:1:"n";s:7:"Project";s:2:"dn";s:18:"Módulo de Projeto";s:1:"u";s:70:"https://lojadodesenvolvedor.com.br/product-tag/modulos-adicionais-php/";s:1:"d";s:83:"Gerencie projetos, tarefas, registros de tempo de tarefas, atividades e muito mais.";}i:5;a:4:{s:1:"n";s:6:"Repair";s:2:"dn";s:17:"Módulo de Reparo";s:1:"u";s:70:"https://lojadodesenvolvedor.com.br/product-tag/modulos-adicionais-php/";s:1:"d";s:297:"O módulo de reparo ajuda com o gerenciamento completo do serviço de reparo de produtos eletrônicos como Celular, Computadores, Desktops, Tablets, Televisão, Relógio, Dispositivos sem fio, Impressoras, Instrumentos eletrônicos e muitos outros dispositivos semelhantes que você pode imaginar!";}i:6;a:4:{s:1:"n";s:3:"Crm";s:2:"dn";s:14:"Módulo de CRM";s:1:"u";s:70:"https://lojadodesenvolvedor.com.br/product-tag/modulos-adicionais-php/";s:1:"d";s:50:"Módulo de gestão de relacionamento com o cliente";}i:7;a:4:{s:1:"n";s:16:"ProductCatalogue";s:2:"dn";s:28:"Módulo Catálogo de produto";s:1:"u";s:70:"https://lojadodesenvolvedor.com.br/product-tag/modulos-adicionais-php/";s:1:"d";s:41:"Módulo de catálogo de produtos digitais";}}
';
    }
}
