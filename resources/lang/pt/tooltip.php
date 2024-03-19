<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tooltip Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various help texts.
    |
    */

    'product_stock_alert' => "Produtos com baixo estoque.<br/><small class='text-muted'>Com base na quantidade de alerta de produto definida na tela de adicionar produto.<br> Compre estes produtos antes que o estoque termine.</small>",

    'payment_dues' => "Pendente de pagamento para compras. <br/><small class='text-muted'>Com base no prazo de pagamento do fornecedor. <br/> Mostrando pagamentos a serem pagos em 7 dias ou menos.</small>",

    'input_tax' => 'Taxa total coletada para vendas no período de tempo selecionado.',

    'output_tax' => 'Taxa total paga para compras no período de tempo selecionado.',

    'tax_overall' => 'Diferença entre o taxa total cobrada e o taxa total paga no período de tempo selecionado.',

    'purchase_due' => 'Valor total não pago para compras.',

    'sell_due' => 'Valor total a ser recebido das vendas',

    'over_all_sell_purchase' => '-ve valor = Valor a pagar <br>+ve Valor = Valor a receber',

    'no_of_products_for_trending_products' => 'Número dos produtos mais populares a serem comparados no gráfico abaixo.',

    'top_trending_products' => "Produtos mais vendidos da sua loja. <br/><small class='text-muted'>Aplique filtros para conhecer produtos em alta para categorias, marcas, locais de negócios específicos etc.</small>",

    'sku' => "ID de produto exclusivo ou unidade de manutenção de estoque <br><br>Mantenha-o em branco para gerar sku automaticamente.<br><small class='text-muted'>Você pode modificar o prefixo sku nas configurações de negócios.</small>",

    'enable_stock' => "Habilite ou desabilite o gerenciamento de estoque de um produto. <br><br><small class='text-muted'>Gerenciamento de estoque deve ser desativado principalmente para serviços. Exemplo: corte de cabelo, reparo, etc.</small>",

    'alert_quantity' => "Receba alertas quando o estoque do produto atingir ou ficar abaixo da quantidade especificada.<br><br><small class='text-muted'>Produtos com pouco estoque serão exibidos no painel - seção Alerta de estoque de produto.</small>",

    'product_type' => '<b>Produto Simples</b>: Produto sem variações.
    <br><b>Produto variável</b>: Produto com variações como tamanho, cor etc.
    <br><b>Combo</b>:Uma combinação de vários produtos, também chamada de produto em pacote',

    'profit_percent' => "Margem de lucro padrão para o produto. <br><small class='text-muted'>(<i>Você pode gerenciar a margem de lucro padrão nas configurações de negócios.</i>)</small>",

    'pay_term' => "Pagamentos a serem pagos por compras/vendas dentro do período de tempo determinado.<br/><small class='text-muted'>Todos os pagamentos futuros ou vencidos serão exibidos no Painel - Seção Pagamento devido</small>",

    'order_status' => 'Os produtos desta compra estarão disponíveis para venda apenas se o <b>Status do pedido</b> for <b>Itens Recebidos</b>.',

    'purchase_location' => 'Local da empresa onde o produto adquirido estará disponível para venda.',

    'sale_location' => 'Local da empresa de onde você deseja vender',

    'sale_discount' => "Defina 'Desconto de venda padrão' para todas as vendas em Configurações de negócios. Clique no ícone de edição abaixo para adicionar/atualizar o desconto.",

    'sale_tax' => "Defina 'Taxa sobre vendas padrão' para todas as vendas nas configurações de negócios. Clique no ícone de edição abaixo para adicionar/atualizar a taxa do pedido.",

    'default_profit_percent' => "Margem de lucro padrão de um produto. <br><small class='text-muted'>Usado para calcular o preço de venda com base no preço de compra inserido.<br/> Você pode modificar este valor para produtos individuais ao adicionar</small>",

    'fy_start_month' => 'Mês de início do ano financeiro da sua empresas',

    'business_tax' => 'Número fiscal registrado para sua empresa.',

    'invoice_scheme' => "Esquema de fatura significa o formato de numeração da fatura. Selecione o esquema a ser usado para este local de negócios<br><small class='text-muted'><i>Você pode adicionar um novo esquema de fatura</b> nas configurações de fatura</i></small>",

    'invoice_layout' => "Layout de fatura a ser usado para este local de negócios<br><small class='text-muted'>(<i>Você pode adicionar novos <b>Invoice Layout</b> em <b>Configurações de fatura<b></i>)</small>",

    'invoice_scheme_name' => 'Dê um nome curto significativo para o esquema de fatura.',

    'invoice_scheme_prefix' => 'Prefixo para um esquema de fatura.<br>Um prefixo pode ser um texto personalizado ou o ano atual. Ex: #XXXX0001, #2018-0002',

    'invoice_scheme_start_number' => "Número inicial para numeração da fatura. <br><small class='text-muted'>Você pode torná-lo 1 ou qualquer outro número a partir do qual a numeração começará.</small>",

    'invoice_scheme_count' => 'Número total de faturas geradas para o esquema de fatura',

    'invoice_scheme_total_digits' => 'Comprimento do número da fatura, excluindo o prefixo da fatura',

    'tax_groups' => 'Grupo de Taxas - definidas acima, para serem usadas em combinação nas seções de compra/venda.',

    'unit_allow_decimal' => "Decimais permite que você venda os produtos relacionados em frações.",

    'print_label' => 'Adicionar produtos -> Escolher informações para mostrar nas etiquetas -> Selecionar configuração de código de barras -> Visualizar etiquetas -> Imprimir',

    'expense_for' => 'Escolha o usuário ao qual a despesa está relacionada. <i>(Optional)</i><br/><small>Exemplo: Salário de um funcionário.</small>',
    
    'all_location_permission' => 'E se <b>Todos os locais</b> selecionada, esta função terá permissão para acessar todos os locais da empresa',

    'dashboard_permission' => 'Se desmarcado, apenas a mensagem de boas-vindas será exibida na página inicial.',

    'access_locations_permission' => 'Escolha todos os locais que esta função pode acessar. Todos os dados do local selecionado serão exibidos apenas para o usuário.<br/><br/><small>por Exemplo: você pode usar isso para definir <i>Gerente de loja / Caixa / Gerente de estoque/Gerente de filial, </i>of Localização particular.</small>',

    'print_receipt_on_invoice' => 'Habilite ou desabilite a impressão automática de fatura na finalização',

    'receipt_printer_type' => "<i>Impressão baseada em navegador</i>: Mostrar caixa de diálogo de impressão do navegador com visualização da fatura<br/><br/> <i>Usar impressora de recibos configurada</i>: Selecione um recibo configurado/impressora térmica para impressão",

    'adjustment_type' => '<i>Normal</i>: Ajuste por motivos normais, como vazamento, danos etc. <br/><br/> <i>Anormal</i>: Ajuste por motivos como incêndio, acidente etc.',

    'total_amount_recovered' => 'Valor recuperado de seguro ou venda de sucatas ou outros',

    'express_checkout' => 'Marcar como pago e finalizar a compra',
    'total_card_slips' => 'Número total de pagamentos com cartão usados neste registro',
    'total_cheques' => 'Número total de cheques usados neste registro',

    'capability_profile' => "O suporte para comandos e páginas de código varia entre os fornecedores e modelos de impressora. Se você não tiver certeza, é uma boa ideia usar o Perfil de Capacidade 'simples'",

    'purchase_different_currency' => 'Escolha esta opção se você comprar em uma moeda diferente da moeda da sua empresa',

    'currency_exchange_factor' => "1 Purchase Currency = ? Base Currency <br> <small class='text-muted'>Você pode habilitar/desabilitar 'Compra em outra moeda' nas configurações de negócios.</small>",

    'accounting_method' => 'Método de contabilidade',

    'transaction_edit_days' => 'Número de dias a partir da data da transação até os quais uma transação pode ser editada.',
    'stock_expiry_alert' => "Lista de ações com vencimento em :days dias <br> <small class='text-muted'>Você pode definir o nº de dias nas configurações de negócios </small>",
    'sub_sku' => "Sku é opcional. <br><br><small>Mantenha-o em branco para gerar o SKU automaticamente.<small>",
    'shipping' => "Defina os detalhes e despesas de envio. Clique no ícone de edição abaixo para adicionar/atualizar detalhes de envio e encargos."
];
