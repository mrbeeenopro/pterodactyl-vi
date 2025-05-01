import React, { useState } from 'react';
import rotateDatabasePassword from '@/api/server/databases/rotateDatabasePassword';
import { Actions, useStoreActions } from 'easy-peasy';
import { ApplicationStore } from '@/state';
import { ServerContext } from '@/state/server';
import { ServerDatabase } from '@/api/server/databases/getServerDatabases';
import { httpErrorToHuman } from '@/api/http';
import Button from '@/components/elements/Button';
import tw from 'twin.macro';

// Thành phần React để xoay mật khẩu cơ sở dữ liệu
export default ({ databaseId, onUpdate }: { databaseId: string; onUpdate: (database: ServerDatabase) => void }) => {
    const [loading, setLoading] = useState(false); // Trạng thái tải
    const { addFlash, clearFlashes } = useStoreActions((actions: Actions<ApplicationStore>) => actions.flashes); // Hành động thông báo
    const server = ServerContext.useStoreState((state) => state.server.data!); // Lấy thông tin máy chủ từ ngữ cảnh

    if (!databaseId) {
        return null; // Nếu không có ID cơ sở dữ liệu, không hiển thị gì
    }

    const rotate = () => {
        setLoading(true); // Bắt đầu trạng thái tải
        clearFlashes(); // Xóa thông báo cũ

        rotateDatabasePassword(server.uuid, databaseId) // Gọi API để xoay mật khẩu
            .then((database) => onUpdate(database)) // Cập nhật cơ sở dữ liệu sau khi thành công
            .catch((error) => {
                console.error(error); // Ghi lỗi vào console
                addFlash({
                    type: 'error', // Loại thông báo lỗi
                    title: 'Lỗi', // Tiêu đề thông báo
                    message: httpErrorToHuman(error), // Chuyển lỗi thành thông báo dễ hiểu
                    key: 'database-connection-modal',
                });
            })
            .then(() => setLoading(false)); // Kết thúc trạng thái tải
    };

    return (
        <Button isSecondary color={'primary'} css={tw`mr-2`} onClick={rotate} isLoading={loading}>
            Xoay mật khẩu
        </Button>
    );
};
