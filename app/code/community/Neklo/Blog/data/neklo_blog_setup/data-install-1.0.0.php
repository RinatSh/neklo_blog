<?php
/**
 * News data installation script
 */
/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */

$installer = $this;

/**
 * @var $model Neklo_Blog_Model_News
 */
$model = Mage::getModel('neklo_blog/news');
// Set up data rows
$dataRows = array(
    array(
        'title' => 'Magento Developer Certification Exams Now Available Worldwide',
        'author' => 'Beth Gomez',
        'published_at' => '2011-12-22',
        'content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                        into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    <ul>
        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</li>
        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</li>
        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</li>
    </ul>
    <p><br />Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s,
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
    ),
    array(
        'title' => 'Introducing Magento Enterprise Premium!',
        'author' => 'Pedram Yasharel',
        'published_at' => '2011-11-23',
        'content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                        into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    <ul>
        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</li>
        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</li>
        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</li>
    </ul>
    <p><br />Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s,
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
    ),
    array(
        'title' => 'Magento Supports Facebook Open Graph 2.0!',
        'author' => 'Baruch Toledano',
        'published_at' => '2011-10-18',
        'content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s,
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'
    ),
);
// Generate news items
foreach ($dataRows as $data) {
    $model->setData($data)->setOrigData()->save();
}
