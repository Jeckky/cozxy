<?=

$this->render('@app/themes/cozxy/layouts/order/_order_summary', [
    'order' => $order,
    'userPoint' => $userPoint, 'addressIdsummary' => $addressIdsummary
])
?>
