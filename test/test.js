import { Selector } from 'testcafe';

const download_link = Selector('td a:first-of-type');
const delete_button = Selector('form #button_delete:first-of-type');

fixture `Getting Started`
    .page `http://localhost:8081/public/index.php`;

test('Perform Text File Upload', async t => {

        await t
            .setFilesToUpload('#FileFormControl', '../samplefiles/MY-IMPORTANT-FILE.txt')
            .click('#SubmitUpload');

});


test('Perform Image File Upload', async t => {

    await t
        .setFilesToUpload('#FileFormControl', '../samplefiles/MY-IMPORTANT-IMAGE.jpg')
        .click('#SubmitUpload');

});


test('File Download', async t => {

    await t

        .click(download_link);

});

test('File Delete', async t => {

    await t

        .click(delete_button);

});

test('File Delete', async t => {

    await t

        .click(delete_button);

});