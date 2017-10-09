<meta charset="utf-8">
<style>
td{
    border: 1px solid;
    padding: 8px 16px;
}

</style>
<pre><?php


require_once('Signage.class.php');
$signage = new Signage();
$aSignage = $signage->getSignageInfo('ankela');


echo '<table cellSpacing=0>';
echo '<tr>
        <th>版本号</th>
        <th>视频地址</th>
        <th>用户KEY</th>
        <th>设备ID</th>
        <th>客户品牌</th>
        <th>门店城市</th>
        <th>门店名称</th>
        <th>水牌位置</th>
        <th>设备码（前）</th>
        <th>设备码（后）</th>
        <th>修改时间</th>
    </tr>';
foreach($aSignage as $val){
    echo '<tr>';
        echo '<td>' . $val[VER] . '</td>';
        echo '<td>' . $val[URL] . '</td>';
        echo '<td>' . $val[KEY] . '</td>';
        echo '<td>' . $val[ID] . '</td>';
        echo '<td>' . $val[BRAND] . '</td>';
        echo '<td>' . $val[CITY] . '</td>';
        echo '<td>' . $val[STORE] . '</td>';
        echo '<td>' . $val[POS] . '</td>';
        echo '<td>' . $val[FRONT_KEY] . '</td>';
        echo '<td>' . $val[END_KEY] . '</td>';
        echo '<td>' . $val[TIME] . '</td>';
    echo '</tr>';
}
echo '</table>';






?></pre>
